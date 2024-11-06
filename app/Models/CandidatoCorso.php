<?php

namespace App\Models;

use Gecche\Cupparis\App\Breeze\Breeze;

/**
 * Breeze (Eloquent) model for candidati_corsi table.
 */
class CandidatoCorso extends Breeze
{

    
//    use ModelWithUploadsTrait;

    protected $table = 'candidati_corsi';

    //protected $fillable = [];

    public $timestamps = true;
    public $ownerships = true;

    public $appends = [

    ];


    public static $relationsData = [

			'candidato' => [self::BELONGS_TO, 'related' => 'App\Models\Candidato', 'table' => 'candidati', 'foreignKey' => 'candidato_id'],
			'corso' => [self::BELONGS_TO, 'related' => 'App\Models\Corso', 'table' => 'corsi', 'foreignKey' => 'corso_id'],


//        'belongsto' => array(self::BELONGS_TO, CandidatoCorso::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, CandidatoCorso::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, CandidatoCorso::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
    ];

    public static $rules = [
//        'username' => 'required|between:4,255|unique:users,username',
    ];

    public $columnsForSelectList = ['candidato_id'];
     //['id','descrizione'];

    public $defaultOrderColumns = ['candidato_id' => 'ASC', 'ordine' => 'ASC', ];
     //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = ['candidato_id'];
     //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 100;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';


}
