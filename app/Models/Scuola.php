<?php

namespace App\Models;

use Gecche\Cupparis\App\Breeze\Breeze;
use Illuminate\Support\Arr;

/**
 * Breeze (Eloquent) model for scuole table.
 */
class Scuola extends Breeze
{
    use Relations\ScuolaRelations;

//    use ModelWithUploadsTrait;

    protected $table = 'scuole';

    protected $guarded = ['id'];

    public $timestamps = true;
    public $ownerships = true;

    public $appends = [
        "provincia_sigla",
    ];

    protected $casts = [
      'info' => 'array',
    ];


    public static $relationsData = [

        'regione' => [self::BELONGS_TO, 'related' => 'App\Models\Regione', 'table' => 'regioni', 'foreignKey' => 'regione_id'],
        'provincia' => [self::BELONGS_TO, 'related' => 'App\Models\Provincia', 'table' => 'province', 'foreignKey' => 'provincia_id'],
        'user' => [self::BELONGS_TO, 'related' => 'App\Models\User', 'table' => 'users', 'foreignKey' => 'user_id'],
        'comunesns' => [self::BELONGS_TO, 'related' => 'App\Models\Comune', 'table' => 'comuni', 'foreignKey' => 'comune_id'],


//        'belongsto' => array(self::BELONGS_TO, Scuola::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, Scuola::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, Scuola::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
    ];

    public static $rules = [
        'denominazione' => 'required',
        'codice' => 'required',
        'provincia_id' => 'required',
//        'username' => 'required|between:4,255|unique:users,username',
    ];

    public $columnsForSelectList = ['codice', 'denominazione'];
    //['id','descrizione'];

    public $defaultOrderColumns = ['denominazione' => 'ASC',];
    //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = ['codice', 'denominazione'];
    //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 100;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';

    public function save(array $options = [])
    {
        if (is_null($this->anno)) {
            $this->anno = date('Y');
        }
        $this->addAnnoToInfo($this->anno);
        if (is_null($this->email_riferimento)) {
            $this->email_riferimento = $this->email;
        }

//        if ($this->email_riferimento) {
//            $user = User::where('email', $this->email_riferimento)->first();
//            if ($user) {
//                $this->user_id = $user->getKey();
//            }
//        }

        if ($this->provincia_id) {
            $provincia = Provincia::where('id',$this->provincia_id)->first();
            $this->regione_id = $provincia->regione_id;
        } else {
            $this->regione_id = null;
        }

        return parent::save($options); // TODO: Change the autogenerated stub
    }


    public function getProvinciaSiglaAttribute() {
        if (!$this->provincia_id) {
            return null;
        }
        return $this->provincia->sigla;
    }


    public function addAnnoToInfo($anno) {
        $info = $this->info;
        if (!is_array($info)) {
            $this->info = [
                'anni' => [
                    $anno => $anno,
                ],
            ];
            return $this->info;
        }
        $anni = Arr::get($info,'anni',[]);
        $anni[$anno] = $anno;

        $info['anni'] = $anni;
        $this->info = $info;
        return $this->info;
    }

    public function getScuolaFE($full = false) {

        if (!$full) {
            return $this->denominazione
                . ' (' . $this->provincia_sigla . ') - Cod:' . $this->codice;
        }

        return $this;
    }
}
