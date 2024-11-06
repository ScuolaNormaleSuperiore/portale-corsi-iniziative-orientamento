<?php

namespace App\Models;

use Gecche\Cupparis\App\Breeze\Breeze;

/**
 * Breeze (Eloquent) model for corsi table.
 */
class Corso extends Breeze
{
	use Relations\CorsoRelations;


    
//    use ModelWithUploadsTrait;

    protected $table = 'corsi';

    //protected $fillable = [];

    public $timestamps = true;
    public $ownerships = true;

    public $appends = [

    ];


    public static $relationsData = [

			'provincia' => [self::BELONGS_TO, 'related' => 'App\Models\Provincia', 'table' => 'province', 'foreignKey' => 'provincia_id'],
			'iniziativa' => [self::BELONGS_TO, 'related' => 'App\Models\Iniziativa', 'table' => 'iniziative', 'foreignKey' => 'iniziativa_id'],
        'candidati' => [self::BELONGS_TO_MANY, 'related' => Candidato::class, 'table' => 'candidati_corsi', 'pivotFields' => ['ordine'], 'foreignPivotKey' => 'corso_id', 'relatedPivotKey' => 'candidato_id'],


//        'belongsto' => array(self::BELONGS_TO, Corso::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, Corso::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, Corso::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
    ];

    public static $rules = [
//        'username' => 'required|between:4,255|unique:users,username',
    ];

    public $columnsForSelectList = ['titolo','luogo','data_inizio','data_fine'];
     //['id','descrizione'];

    public $defaultOrderColumns = ['data_inizio' => 'ASC', ];
     //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = ['titolo'];
     //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 100;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';


}
