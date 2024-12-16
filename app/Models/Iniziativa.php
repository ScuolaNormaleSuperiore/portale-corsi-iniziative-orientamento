<?php

namespace App\Models;

use Gecche\Cupparis\App\Breeze\Breeze;

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
}
