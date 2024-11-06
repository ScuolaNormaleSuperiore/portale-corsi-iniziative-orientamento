<?php

namespace App\Models;

use Gecche\Cupparis\App\Breeze\Breeze;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Breeze (Eloquent) model for sezioni_contenuti table.
 */
class SezioneContenuto extends Breeze
{

    use HasSlug;
//    use ModelWithUploadsTrait;

    protected $table = 'sezioni_contenuti';

    protected $guarded = ['id'];

    public $timestamps = false;
    public $ownerships = false;

    public $appends = [

    ];


    public static $relationsData = [



//        'belongsto' => array(self::BELONGS_TO, SezioneContenuto::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, SezioneContenuto::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, SezioneContenuto::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
    ];

    public static $rules = [
//        'username' => 'required|between:4,255|unique:users,username',
    ];

    public $columnsForSelectList = [];
     //['id','descrizione'];

    public $defaultOrderColumns = ['ordine' => 'ASC', ];
     //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = [];
     //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 100;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nome_it')
            ->saveSlugsTo('slug_it');
    }

}
