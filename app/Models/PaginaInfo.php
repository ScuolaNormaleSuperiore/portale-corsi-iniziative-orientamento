<?php

namespace App\Models;

use Gecche\Cupparis\App\Breeze\Breeze;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Breeze (Eloquent) model for pagine table.
 */
class PaginaInfo extends Breeze
{
	use Relations\PaginaInfoRelations;

    use HasSlug;
    use PaginaTrait;
//    use ModelWithUploadsTrait;

    protected static $tipoPagina = 'info';

    protected $table = 'pagine';

    protected $guarded = [
        'id'
    ];

    public $timestamps = true;
    public $ownerships = true;

    public $appends = [

    ];


    public static $relationsData = [

        'fotos' => [self::MORPH_MANY, 'related' => Foto::class, 'name' => 'mediable'],
        'attachments' => [self::MORPH_MANY, 'related' => Attachment::class, 'name' => 'mediable'],
        'sezioni' => [self::MORPH_MANY, 'related' => SezioneContenuto::class, 'name' => 'sezionable'],


//        'belongsto' => array(self::BELONGS_TO, Pagina::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, Pagina::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, Pagina::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
    ];

    public static $rules = [
//        'username' => 'required|between:4,255|unique:users,username',
    ];

    public $columnsForSelectList = ['titolo_it'];
     //['id','descrizione'];

    public $defaultOrderColumns = ['ordine' => 'ASC', ];
     //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = ['titolo_it'];
     //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 100;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';


}
