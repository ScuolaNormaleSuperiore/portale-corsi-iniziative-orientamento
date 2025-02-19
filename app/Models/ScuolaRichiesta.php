<?php

namespace App\Models;

use App\Mail\RichiestaScuolaAdminEmail;
use App\Notifications\RichiestaScuola;
use App\Notifications\RichiestaScuolaAccettata;
use Gecche\Cupparis\App\Breeze\Breeze;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

/**
 * Breeze (Eloquent) model for scuole_richieste table.
 */
class ScuolaRichiesta extends Breeze
{
	use Relations\ScuolaRichiestaRelations;
    use Notifiable;



//    use ModelWithUploadsTrait;

    protected $table = 'scuole_richieste';

    protected $guarded = ['id'];

    public $timestamps = true;
    public $ownerships = true;

    public $appends = [

    ];


    public static $relationsData = [

			'scuola' => [self::BELONGS_TO, 'related' => 'App\Models\Scuola', 'table' => 'scuole', 'foreignKey' => 'scuola_id'],


//        'belongsto' => array(self::BELONGS_TO, ScuolaRichiesta::class, 'foreignKey' => '<FOREIGNKEYNAME>'),
//        'belongstomany' => array(self::BELONGS_TO_MANY, ScuolaRichiesta::class, 'table' => '<TABLEPIVOTNAME>','pivotKeys' => [],'foreignKey' => '<FOREIGNKEYNAME>','otherKey' => '<OTHERKEYNAME>') ,
//        'hasmany' => array(self::HAS_MANY, ScuolaRichiesta::class, 'table' => '<TABLENAME>','foreignKey' => '<FOREIGNKEYNAME>'),
    ];

    public static $rules = [
//        'username' => 'required|between:4,255|unique:users,username',
    ];

    public $columnsForSelectList = ['email'];
     //['id','descrizione'];

    public $defaultOrderColumns = ['created_at' => 'DESC', ];
     //['cognome' => 'ASC','nome' => 'ASC'];

    public $columnsSearchAutoComplete = ['email'];
     //['cognome','denominazione','codicefiscale','partitaiva'];

    public $nItemsAutoComplete = 20;
    public $nItemsForSelectList = 100;
    public $itemNoneForSelectList = false;
    public $fieldsSeparator = ' - ';

    public function sendNuovaRichiestaNotification()
    {
        $this->notify(new RichiestaScuola());
        Mail::to(config('mail.admin-to.address'))->send(new RichiestaScuolaAdminEmail());
    }

    public function sendAccettataNotification()
    {
        $this->notify(new RichiestaScuolaAccettata());
    }
}
