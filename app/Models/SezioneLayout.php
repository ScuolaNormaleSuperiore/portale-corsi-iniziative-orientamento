<?php

namespace App\Models;

use Gecche\Cupparis\App\Breeze\Breeze;

/**
 * Breeze (Eloquent) model for sezioni_layout table.
 */
class SezioneLayout extends Breeze
{

    
//    use ModelWithUploadsTrait;

    protected $table = 'sezioni_layout';

    //protected $fillable = [];

    public $timestamps = true;
    public $ownerships = true;

    public $appends = [

    ];


    public static $relationsData = [



//        'belongsto' => array(self::BELONGS_TO, SezioneLayout::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, SezioneLayout::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, SezioneLayout::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
    ];

    public static $rules = [
//        'username' => 'required|between:4,255|unique:users,username',
    ];

    public $columnsForSelectList = ['nome'];
     //['id','descrizione'];

    public $defaultOrderColumns = ['nome' => 'ASC', ];
     //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = ['nome'];
     //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 100;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';


}
