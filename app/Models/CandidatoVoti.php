<?php

namespace App\Models;

use Gecche\Cupparis\App\Breeze\Breeze;

/**
 * Breeze (Eloquent) model for candidati_voti table.
 */
class CandidatoVoti extends Breeze
{


//    use ModelWithUploadsTrait;

    protected $table = 'candidati_voti';

    protected $guarded = [
        'id'
    ];

    public $timestamps = true;
    public $ownerships = true;

    public $appends = [

    ];


    public static $relationsData = [

			'candidato' => [self::BELONGS_TO, 'related' => 'App\Models\Candidato', 'table' => 'candidati', 'foreignKey' => 'candidato_id'],
			'materia' => [self::BELONGS_TO, 'related' => 'App\Models\Materia', 'table' => 'materie', 'foreignKey' => 'materia_id'],


//        'belongsto' => array(self::BELONGS_TO, CandidatoVoti::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, CandidatoVoti::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, CandidatoVoti::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
    ];

    public static $rules = [
//        'username' => 'required|between:4,255|unique:users,username',
    ];

    public $columnsForSelectList = ['candidato_id'];
     //['id','descrizione'];

    public $defaultOrderColumns = ['candidato_id' => 'ASC', ];
     //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = ['candidato_id'];
     //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 100;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';


}
