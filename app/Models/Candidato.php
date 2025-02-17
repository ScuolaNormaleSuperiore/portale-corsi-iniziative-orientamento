<?php

namespace App\Models;

use App\Enums\TipoCandidatura;
use App\Services\FormatValues;
use Carbon\Carbon;
use Gecche\Cupparis\App\Breeze\Breeze;
use Gecche\FSM\FSMTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

/**
 * Breeze (Eloquent) model for candidati table.
 */
class Candidato extends Breeze
{
    use Relations\CandidatoRelations;

    use HasFactory;

    use FSMTrait;

    use ScuolaReferredTrait;


    //    use ModelWithUploadsTrait;

    protected $table = 'candidati';

    //protected $fillable = [];

    public $timestamps = true;
    public $ownerships = true;

    public $appends = [
        'fename',
        'tipo_text',
    ];

    protected $casts = [
        'info' => 'array',
        'stages' => 'array',
        'gare_internazionali' => 'array',
        'gare_umanistiche' => 'array',
    ];


    public static $relationsData = [

        'iniziativa' => [self::BELONGS_TO, 'related' => Iniziativa::class, 'table' => 'scuole', 'foreignKey' => 'iniziativa_id'],
        'scuola' => [self::BELONGS_TO, 'related' => Scuola::class, 'table' => 'scuole', 'foreignKey' => 'scuola_id'],
        'user' => [self::BELONGS_TO, 'related' => User::class, 'table' => 'users', 'foreignKey' => 'user_id'],
        'comune' => [self::BELONGS_TO, 'related' => Comune::class, 'table' => 'comuni', 'foreignKey' => 'comune_id'],
        'provincia' => [self::BELONGS_TO, 'related' => Provincia::class, 'table' => 'province', 'foreignKey' => 'provincia_id'],
        'regione' => [self::BELONGS_TO, 'related' => Regione::class, 'table' => 'regioni', 'foreignKey' => 'regione_id'],
        'nazione' => [self::BELONGS_TO, 'related' => Nazione::class, 'table' => 'nazioni', 'foreignKey' => 'nazione_id'],
        'modalita' => [self::BELONGS_TO, 'related' => ModalitaConoscenzaSns::class, 'table' => 'modalita_conoscenza_sns', 'foreignKey' => 'modalita_conoscenza_sns_id'],

        'titolo1' => [self::BELONGS_TO, 'related' => TitoloStudio::class, 'table' => 'titoli_studio', 'foreignKey' => 'gen1_titolo_studio_id'],
        'titolo2' => [self::BELONGS_TO, 'related' => TitoloStudio::class, 'table' => 'titoli_studio', 'foreignKey' => 'gen2_titolo_studio_id'],
        'professione1' => [self::BELONGS_TO, 'related' => Professione::class, 'table' => 'professioni', 'foreignKey' => 'gen1_professione_id'],
        'professione2' => [self::BELONGS_TO, 'related' => Professione::class, 'table' => 'professioni', 'foreignKey' => 'gen2_professione_id'],

        'inglese' => [self::BELONGS_TO, 'related' => LivelloLinguistico::class, 'table' => 'livelli_linguistici', 'foreignKey' => 'inglese_livello_linguistico_id'],
        'francese' => [self::BELONGS_TO, 'related' => LivelloLinguistico::class, 'table' => 'livelli_linguistici', 'foreignKey' => 'francese_livello_linguistico_id'],
        'spagnolo' => [self::BELONGS_TO, 'related' => LivelloLinguistico::class, 'table' => 'livelli_linguistici', 'foreignKey' => 'spagnolo_livello_linguistico_id'],
        'tedesco' => [self::BELONGS_TO, 'related' => LivelloLinguistico::class, 'table' => 'livelli_linguistici', 'foreignKey' => 'tedesco_livello_linguistico_id'],
        'cinese' => [self::BELONGS_TO, 'related' => LivelloLinguistico::class, 'table' => 'livelli_linguistici', 'foreignKey' => 'cinese_livello_linguistico_id'],

        'corsi' => [self::BELONGS_TO_MANY, 'related' => Corso::class, 'table' => 'candidati_corsi', 'pivotFields' => ['ordine'], 'foreignPivotKey' => 'candidato_id', 'relatedPivotKey' => 'corso_id'],
        'voti' => [self::HAS_MANY, 'related' => CandidatoVoti::class, 'table' => 'candidati_voti', 'foreignKey' => 'candidato_id'],

        //        'belongsto' => array(self::BELONGS_TO, Candidato::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
        //        'belongstomany' => array(self::BELONGS_TO_MANY, Candidato::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
        //        'hasmany' => array(self::HAS_MANY, Candidato::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
        'attachments' => [self::MORPH_MANY, 'related' => Attachment::class, 'name' => 'mediable'],
    ];

    public static $rules = [
        'cognome' => 'required',
        'nome' => 'required',
        //        'username' => 'required|between:4,255|unique:users,username',
    ];

    public $columnsForSelectList = ['nome', 'cognome'];
    //['id','descrizione'];

    public $defaultOrderColumns = ['cognome' => 'ASC', 'nome' => 'ASC',];
    //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = ['nome', 'cognome'];
    //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 100;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';

    public function save(array $options = [])
    {
        if (!$this->getKey()) {
            $this->startFSM();
            if (!$this->user_id) {

                $this->user_id = Auth::id();
                switch (auth_role_name()) {
                    case 'Scuola':
                        $this->tipo = 'scuola';
                        break;
                    case 'Studente':
                        $this->tipo = 'studente';
                        break;
                    default:
                        $this->tipo = 'altro';
                        break;
                }
            }
        }

        if (is_null($this->informativa)) {
            $this->informativa = 0;
        }
        if ($this->iniziativa) {
            $this->anno = $this->iniziativa->anno;
        }

        if ($this->nazione_id == 1) {
            $this->provincia_id = $this->comune->provincia_id;
            $provincia = Provincia::where('id', $this->provincia_id)->first();
            $this->regione_id = $provincia->regione_id;
            $this->nazione_id = 1;
            $this->comune_estero = null;
        } else {
            $this->regione_id = null;
            $this->provincia_id = null;
        }

        if ($this->scuola_id) {
            $this->scuola_estera = null;
        }
        return parent::save($options); // TODO: Change the autogenerated stub
    }

    public function getFenameAttribute()
    {
        if (!$this->getKey()) {
            return "N.D.";
        }
        if ($this->nome) {
            return trim($this->nome . ' ' . $this->cognome);
        }

        return $this->emails ?: "N.D.";
    }

    public function getInfoAttribute($value)
    {
        $value = json_decode($value, true);
        if (!is_array($value)) {
            return [
                'steps' => [],
            ];
        }
        if (!array_key_exists('steps', $value)) {
            $value['steps'] = [];
        }
        return $value;
    }

    public function getDefaultArray($value)
    {
        $value = json_decode($value, true);
        if (!is_array($value)) {
            return [];
        }
        return $value;
    }

    public function getStagesAttribute($value)
    {
        return $this->getDefaultArray($value);
    }

    public function getGareInternazionaliAttribute($value)
    {
        return $this->getDefaultArray($value);
    }

    public function getGareUmanisticheAttribute($value)
    {
        return $this->getDefaultArray($value);
    }

    public function addStepToInfo($step)
    {
        $info = $this->info;
        $info['steps'][$step] = true;
        $this->info = $info;
        return $this->info;
    }

    public function getLastTimestamp()
    {
        $timestamp = Arr::get($this->getLastStatus(), 'timestamp');
        try {
            return Carbon::createFromFormat('Y-m-d H:i:s', $timestamp);
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function getTipoTextAttribute()
    {
        return TipoCandidatura::optionLabel($this->tipo);
    }


    public function calculateMedia($save = false)
    {
        $media = 0;

        $nMaterie = 0;
        foreach ($this->voti()->with('materia')->get() as $voto) {
            if ($voto->materia->moltiplicatore <= 0) {
                continue;
            }
            $media += ($voto->voto_anno_2 + $voto->voto_anno_1
                + $voto->voto_primo_quadrimestre) / 3 * $voto->materia->moltiplicatore;
            $nMaterie++;
        }
        if ($nMaterie > 0) {
            $media = $media / $nMaterie;
        }

        $media = FormatValues::formatNumber0($media, 2);
        $this->media = $media;
        if ($save) {
            $this->save();
        }
        return $media;
    }

    public function delete()
    {

        $attachments = $this->attachments;
        $deleted = parent::delete(); // TODO: Change the autogenerated stub

        if ($deleted) {
            foreach ($attachments as $attachment) {
                $attachment->delete();
            }
        }
        return $deleted;
    }
}
