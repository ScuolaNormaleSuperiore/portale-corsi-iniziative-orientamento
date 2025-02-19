<?php

namespace App\Models;

use App\Enums\CandidatoStatuses;
use Gecche\Cupparis\App\Breeze\Breeze;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Breeze (Eloquent) model for iniziative table.
 */
class Iniziativa extends Breeze
{
	use Relations\IniziativaRelations;



//    use ModelWithUploadsTrait;

    protected $table = 'iniziative';

    //protected $fillable = [];

    public $timestamps = true;
    public $ownerships = true;

    public $appends = [
        'voti_labels',
    ];


    public static $relationsData = [

        'filtri' => [self::BELONGS_TO_MANY, 'related' => FiltroSelezione::class,
            'table' => 'iniziative_filtri_selezioni',
            'foreignKey' => 'iniziativa_id', 'otherKey' => 'filtro_id'],

        'corsi' => [self::HAS_MANY, 'related' => Corso::class,
            'foreignKey' => 'iniziativa_id'
        ],
        'candidati' => [self::HAS_MANY, 'related' => Candidato::class,
            'foreignKey' => 'iniziativa_id'
        ],
        'authcandidature' => [self::HAS_MANY, 'related' => Candidato::class,
            'foreignKey' => 'iniziativa_id'
        ],

//        'belongsto' => array(self::BELONGS_TO, Iniziativa::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, Iniziativa::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, Iniziativa::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
    ];

    public static $rules = [
        'anno' => 'required',
        'titolo' => 'required',
        'data_apertura' => 'required|date',
        'data_chiusura' => 'required|date',
        'modalita_candidatura' => 'required',
        'attivo' => 'required',

//        'username' => 'required|between:4,255|unique:users,username',
    ];
    public $columnsForSelectList = ['titolo'];
     //['id','descrizione'];

    public $defaultOrderColumns = ['anno' => 'ASC', 'data_apertura' => 'ASC', 'titolo' => 'ASC', ];
     //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = ['titolo'];
     //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 100;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';




    public static function getModalitaCandidaturaOptions() {
        return [
            'singola' => "Solo candidatura singola",
            'scuola' => "Solo candidatura tramite scuola",
            'singola_sccuola' => "Candidatura singola e tramite scuola",
        ];
    }

    public function getCandidatureData() {


        if (!$this->getKey()) {
            return [
                'totale' => 0,
                'totale_stati' => [],
                'totale_stati_regioni' => [],
            ];
        }

        $regioni = Regione::all()->pluck('nome')->all();
        $totaleCandidature = DB::table('candidati')
            ->where('iniziativa_id',$this->getKey())
            ->count();


        $candidatureStati = DB::table('candidati')
            ->selectRaw('COUNT(*) as tot, status')
            ->where('iniziativa_id',$this->getKey())
            ->groupBy('status')
            ->get()
            ->pluck('tot','status')
            ->all();

        $candidatureStati = array_merge(
            array_fill_keys(array_keys(CandidatoStatuses::states()), 0)
            ,$candidatureStati);

        $candidatureStati['inviata'] += $candidatureStati['approvata'] + $candidatureStati['rifiutata'];
        $candidatureStati['totale'] = $candidatureStati['inviata'] + $candidatureStati['bozza'];

        $candidatureStatiRegioniRaw = DB::table('candidati')
            ->selectRaw('COUNT(*) as tot, status, regioni.nome as regione')
            ->where('iniziativa_id',$this->getKey())
            ->join('regioni','regione_id', '=' , 'regioni.id')
            ->groupBy('status','regione')
            ->get();

        $candidatureStatiRegioni = CandidatoStatuses::states();
        $candidatureStatiRegioni['totale'] = [];
        foreach ($candidatureStatiRegioni as $key => $item) {
            $candidatureStatiRegioni[$key] = array_fill_keys($regioni,0);
        }
        $maxStatiRegioni = array_fill_keys(array_keys($candidatureStatiRegioni), 0);
        foreach ($candidatureStatiRegioniRaw as $record) {
            $candidatureStatiRegioni[$record->status][$record->regione] = $record->tot;
            if ($maxStatiRegioni[$record->status] < $record->tot) {
                $maxStatiRegioni[$record->status] = $record->tot;
            }
        }

        foreach ($candidatureStatiRegioni['inviata'] as $regione => $totale) {
            $newTotale = $totale +
                $candidatureStatiRegioni['approvata'][$regione] +
                $candidatureStatiRegioni['rifiutata'][$regione];

            $candidatureStatiRegioni['inviata'][$regione] = $newTotale;
            $candidatureStatiRegioni['totale'][$regione] = $candidatureStatiRegioni['inviata'][$regione] + $candidatureStatiRegioni['bozza'][$regione];
            if ($maxStatiRegioni['inviata'] < $newTotale) {
                $maxStatiRegioni['inviata'] = $newTotale;
            }
            if ($maxStatiRegioni['totale'] < $candidatureStatiRegioni['totale'][$regione]) {
                $maxStatiRegioni['totale'] = $candidatureStatiRegioni['totale'][$regione];
            }
        }


        $fasce = [];
        foreach ($maxStatiRegioni as $status => $max) {

            $fasce[$status] = [["label"  => "Nessuna candidatura", "min" => 0]];
            if ($max == 0) {
                continue;
            }
            if ($max <= 6) {
                foreach (range(1,$max) as $curr) {
                    $fasce[$status] = [(string)$curr => $curr];
                }
                continue;
            }
            foreach (range(1,4) as $curr) {
                $floor = floor(($max-1) / 5 * $curr);
                if ($curr == 1) {
                    $fasce[$status][] = ["label" => "Da 1 a " . $floor, "min" => 1];
                }
                $ceil =  min(floor(($max-1) / 5 * ($curr+1)),$max-1);

                if ($floor == $ceil) {
                    $fasce[$status][(string)$floor] = $floor;
                } else {
                    $fasce[$status][] = ["label" =>  "Da " . $floor . ' a ' . $ceil, "min" => $floor];
                }
            }
            $fasce[$status][] = ["label" =>  "Max: " . (string)$max, "min" => $max];



        }


        return [
            'totale' => $totaleCandidature,
            'totale_stati' => $candidatureStati,
            'totale_stati_regioni' => $candidatureStatiRegioni,
            'max_stati_regioni' => $maxStatiRegioni,
            'fasce_stati_regioni' => $fasce,
        ];

    }

    public function getDatiStatisticiAttribute() {
        return $this->getCandidatureData();
    }

    public function getVotiLabelsAttribute() {
        $year = date('y');
        if (Str::length($this->anno) == 4) {
            $year = substr($this->anno,2,2);
        }
        $year = intval($year);

        $year3 = $year - 3;
        $year2 = $year - 2;
        $year1 = $year - 1;
        return [
            'voto_anno_2' => "Voto finale " . $year3 . '/' . $year2,
            'voto_anno_1' => "Voto finale " . $year2 . '/' . $year1,
            'voto_primo_quadrimestre' => "Voto 1° Quad. " . $year1 . '/' . $year,
        ];
    }
}
