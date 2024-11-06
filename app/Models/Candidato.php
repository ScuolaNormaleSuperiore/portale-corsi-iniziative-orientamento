<?php

namespace App\Models;

use Gecche\Cupparis\App\Breeze\Breeze;

/**
 * Breeze (Eloquent) model for candidati table.
 */
class Candidato extends Breeze
{
	use Relations\CandidatoRelations;



//    use ModelWithUploadsTrait;

    protected $table = 'candidati';

    //protected $fillable = [];

    public $timestamps = true;
    public $ownerships = true;

    public $appends = [

    ];


    public static $relationsData = [

        'iniziativa' => [self::BELONGS_TO, 'related' => Iniziativa::class, 'table' => 'scuole', 'foreignKey' => 'iniziativa_id'],
        'scuola' => [self::BELONGS_TO, 'related' => Scuola::class, 'table' => 'scuole', 'foreignKey' => 'scuola_id'],
        'user' => [self::BELONGS_TO, 'related' => User::class, 'table' => 'users', 'foreignKey' => 'user_id'],
        'provincia' => [self::BELONGS_TO, 'related' => Provincia::class, 'table' => 'province', 'foreignKey' => 'provincia_id'],
        'regione' => [self::BELONGS_TO, 'related' => Provincia::class, 'table' => 'province', 'foreignKey' => 'provincia_id'],
        'modalita' => [self::BELONGS_TO, 'related' => ModalitaConoscenzaSns::class, 'table' => 'modalita_conoscenza_sns', 'foreignKey' => 'modalita_conoscenza_sns_id'],

        'titolo1' => [self::BELONGS_TO, 'related' => TitoloStudio::class, 'table' => 'titoli_studio', 'foreignKey' => 'gen1_titolo_studio_id'],
        'titolo2' => [self::BELONGS_TO, 'related' => TitoloStudio::class, 'table' => 'titoli_studio', 'foreignKey' => 'gen2_titolo_studio_id'],
        'professione1' => [self::BELONGS_TO, 'related' => Professione::class, 'table' => 'professioni', 'foreignKey' => 'gen1_professione_id'],
        'professione2' => [self::BELONGS_TO, 'related' => Professione::class, 'table' => 'professioni', 'foreignKey' => 'gen2_professione_id'],

        'inglese' => [self::BELONGS_TO, 'related' => LivelloLinguistico::class, 'table' => 'livelli_linguistici', 'foreignKey' => 'inglese_livello_linguistico_id'],
        'francese' => [self::BELONGS_TO, 'related' => LivelloLinguistico::class, 'table' => 'livelli_linguistici', 'foreignKey' => 'francese_livello_linguistico_id'],
        'spagnolo' => [self::BELONGS_TO, 'related' => LivelloLinguistico::class, 'table' => 'livelli_linguistici', 'foreignKey' => 'spagnolo_livello_linguistico_id'],
        'tedesco' => [self::BELONGS_TO, 'related' => LivelloLinguistico::class, 'table' => 'livelli_linguistici', 'foreignKey' => 'tedesco_livello_linguistico_id'],
        'cinese' => [self::BELONGS_TO, 'related' => LivelloLinguistico::class, 'table' => 'livelli_linguistici', 'foreignKey' => 'cinese_livello_linguistico_id'],

        'corsi' => [self::BELONGS_TO_MANY, 'related' => Corso::class, 'table' => 'candidati_corsi', 'pivotFields' => ['ordine'], 'foreignPivotKey' => 'candidato_id', 'relatedPivotKey' => 'corso_id'],
        'voti' => [self::HAS_MANY, 'related' => CandidatoVoti::class, 'table' => 'candidati_voti', 'foreignKey' => 'candidato_id'],

//        'belongsto' => array(self::BELONGS_TO, Candidato::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, Candidato::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, Candidato::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
    ];

    public static $rules = [
//        'username' => 'required|between:4,255|unique:users,username',
    ];

    public $columnsForSelectList = ['nome', 'cognome'];
    //['id','descrizione'];

    public $defaultOrderColumns = ['cognome' => 'ASC', 'nome' => 'ASC',];
    //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = ['nome', 'cognome'];
    //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 100;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';


}
