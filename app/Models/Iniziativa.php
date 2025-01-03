<?php

namespace App\Models;

use App\Enums\CandidatoStatuses;
use Gecche\Cupparis\App\Breeze\Breeze;
use Illuminate\Support\Facades\DB;

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

        $candidatureStatiRegioniRaw = DB::table('candidati')
            ->selectRaw('COUNT(*) as tot, status, regioni.nome as regione')
            ->where('iniziativa_id',$this->getKey())
            ->join('regioni','regione_id', '=' , 'regioni.id')
            ->groupBy('status','regione')
            ->get();

        $candidatureStatiRegioni = CandidatoStatuses::states();
        foreach ($candidatureStatiRegioniRaw as $record) {
            $candidatureStatiRegioni[$record->status][$record->regione] = $record->tot;
        }

        return [
            'totale' => $totaleCandidature,
            'totale_stati' => $candidatureStati,
            'totale_stati_regioni' => $candidatureStatiRegioni,
        ];

    }

    public function getDatiStatisticiAttribute() {
        return $this->getCandidatureData();
    }
}
