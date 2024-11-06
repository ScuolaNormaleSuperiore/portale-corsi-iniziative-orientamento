<?php

namespace App\Models;

use Gecche\Cupparis\App\Breeze\Breeze;

/**
 * Breeze (Eloquent) model for studenti_orientamento table.
 */
class StudenteOrientamento extends Breeze
{
	use Relations\StudenteOrientamentoRelations;


    
//    use ModelWithUploadsTrait;

    protected $table = 'studenti_orientamento';

    //protected $fillable = [];

    public $timestamps = true;
    public $ownerships = true;

    public $appends = [

    ];


    public static $relationsData = [

			'materia' => [self::BELONGS_TO, 'related' => 'App\Models\MateriaOrientamento', 'table' => 'materie_orientamento', 'foreignKey' => 'materia_id'],
        'fotos' => [self::MORPH_MANY, 'related' => Foto::class, 'name' => 'mediable'],


//        'belongsto' => array(self::BELONGS_TO, StudenteOrientamento::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, StudenteOrientamento::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, StudenteOrientamento::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
    ];

    public static $rules = [
//        'username' => 'required|between:4,255|unique:users,username',
    ];

    public $columnsForSelectList = ['nome', 'cognome'];
     //['id','descrizione'];

    public $defaultOrderColumns = ['cognome' => 'ASC', 'nome' => 'ASC', ];
     //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = ['nome', 'cognome'];
     //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 100;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';


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

    public static function getModalitaCandidaturaOptions() {
        return [
            'singola' => "Solo candidatura singola",
            'scuola' => "Solo candidatura tramite scuola",
            'singola_sccuola' => "Candidatura singola e tramite scuola",
        ];
    }
}
