<?php

namespace App\Models;

use Gecche\Cupparis\App\Breeze\Breeze;

/**
 * Breeze (Eloquent) model for filtri_selezioni table.
 */
class FiltroSelezione extends Breeze
{
	use Relations\FiltroSelezioneRelations;


    
//    use ModelWithUploadsTrait;

    protected $table = 'filtri_selezioni';

    //protected $fillable = [];

    public $timestamps = true;
    public $ownerships = true;

    public $appends = [

    ];


    public static $relationsData = [

			'iniziative' => [self::BELONGS_TO_MANY, 'related' => 'App\Models\Iniziativa',
                'table' => 'iniziative_filtri_selezioni',
                'foreignKey' => 'filtro_id', 'otherKey' => 'iniziativa_id'],


//        'belongsto' => array(self::BELONGS_TO, FiltroSelezione::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, FiltroSelezione::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, FiltroSelezione::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
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
