<?php

namespace App\Models;

use Gecche\Cupparis\App\Breeze\Breeze;

/**
 * Breeze (Eloquent) model for province table.
 */
class Provincia extends Breeze
{
	use Relations\ProvinciaRelations;


    
//    use ModelWithUploadsTrait;

    protected $table = 'province';

    protected $guarded = ['id'];

    public $timestamps = true;
    public $ownerships = true;

    public $appends = [

    ];


    public static $relationsData = [

			'regione' => [self::BELONGS_TO, 'related' => 'App\Models\Regione', 'table' => 'regioni', 'foreignKey' => 'regione_id'],


//        'belongsto' => array(self::BELONGS_TO, Provincia::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, Provincia::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, Provincia::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
    ];

    public static $rules = [
//        'username' => 'required|between:4,255|unique:users,username',
    ];

    public $columnsForSelectList = ['nome', 'sigla'];
     //['id','descrizione'];

    public $defaultOrderColumns = ['nome' => 'ASC', ];
     //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = ['nome', 'sigla'];
     //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 200;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';


}
