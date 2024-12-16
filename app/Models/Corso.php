<?php

namespace App\Models;

use App\Services\FormatValues;
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


        'fotos' => [self::MORPH_MANY, 'related' => Foto::class, 'name' => 'mediable'],
        'attachments' => [self::MORPH_MANY, 'related' => Attachment::class, 'name' => 'mediable'],

//        'belongsto' => array(self::BELONGS_TO, Iniziativa::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, Iniziativa::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, Iniziativa::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
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

    public function getCorsoFE() {

        return $this->titolo
            . ' - ' . $this->luogo . ' dal ' . FormatValues::formatDateIta($this->data_inizio)
            . ' al ' . FormatValues::formatDateIta($this->data_fine);
    }

    public function getPictureAttribute()
    {
        $foto = $this->fotos->first();
//        Log::info(print_r($foto,true));
        if ($foto) {
            return $foto->getUrl('orig');
        }
        return null;
    }

    public function getPictureIconAttribute()
    {
        $foto = $this->fotos->first();
//        Log::info(print_r($foto,true));
        if ($foto) {
            return $foto->getUrl('iniziativaicon');
        }
        return '/imagecache/small/0';
    }
}
