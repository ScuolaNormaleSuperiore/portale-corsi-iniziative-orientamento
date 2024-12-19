<?php

namespace App\Models;

use App\Enums\AvvisiTipologie;
use App\Enums\TipoCandidatura;
use Gecche\Cupparis\App\Breeze\Breeze;

/**
 * Breeze (Eloquent) model for avvisi table.
 */
class Avviso extends Breeze
{


//    use ModelWithUploadsTrait;

    protected $table = 'avvisi';

    //protected $fillable = [];

    public $timestamps = true;
    public $ownerships = true;

    public $appends = [
        'tipo_text',
    ];


    public static $relationsData = [



//        'belongsto' => array(self::BELONGS_TO, Avviso::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, Avviso::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, Avviso::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
    ];

    public static $rules = [
//        'username' => 'required|between:4,255|unique:users,username',
    ];

    public $columnsForSelectList = ['descrizione'];
     //['id','descrizione'];

    public $defaultOrderColumns = ['created_at' => 'DESC', ];
     //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = ['descrizione'];
     //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 100;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';

    public function getTipoTextAttribute() {
        return AvvisiTipologie::optionLabel($this->tipo);
    }
}
