<?php

namespace App\Models;

use Gecche\Cupparis\App\Breeze\Breeze;

/**
 * Breeze (Eloquent) model for materie_orientamento table.
 */
class MateriaOrientamento extends Breeze
{
    use Relations\MateriaOrientamentoRelations;


//    use ModelWithUploadsTrait;

    protected $table = 'materie_orientamento';

    //protected $fillable = [];

    public $timestamps = true;
    public $ownerships = true;

    public $appends = [

    ];


    public static $relationsData = [

        'classe' => [self::BELONGS_TO, 'related' => 'App\Models\Classe', 'table' => 'classi', 'foreignKey' => 'classe_id'],
        'studenti' => [self::HAS_MANY, 'related' => StudenteOrientamento::class, 'table' => 'student_orientamento', 'foreignKey' => 'materia_id'],


//        'belongsto' => array(self::BELONGS_TO, MateriaOrientamento::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, MateriaOrientamento::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, MateriaOrientamento::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
    ];

    public static $rules = [
//        'username' => 'required|between:4,255|unique:users,username',
    ];

    public $columnsForSelectList = ['nome_it'];
    //['id','descrizione'];

    public $defaultOrderColumns = ['nome_it' => 'ASC',];
    //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = ['nome_it'];
    //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 100;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';


}
