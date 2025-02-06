<?php

namespace App\Models;

use App\Notifications\CandidaturaInviata;
use App\Notifications\RegistrazioneStudente;
use App\Notifications\VerifyEmail;
use Gecche\Cupparis\App\Models\User as CupparisUser;

use App\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;

class User extends CupparisUser {
	use Relations\UserRelations;

    use HasApiTokens;


    public $appends = [
        'mainrole',
        'fename',
        'codice_fiscale',
    ];

    protected $casts = [
        'info' => 'array',
    ];

    protected $fillable = [
        'name', 'email', 'password',
        'nome', 'cognome', 'email_verified_at',
        'info', 'codice_fiscale',
    ];

    public static $relationsData = [
        'scuola' => [self::HAS_ONE, 'related' => Scuola::class, 'foreignKey' => 'user_id'],
        'fotos' => [self::MORPH_MANY, 'related' => Foto::class, 'name' => 'mediable'],
        'attachments' => [self::MORPH_MANY, 'related' => Attachment::class, 'name' => 'mediable'],
        'roles' => [
            self::MORPH_TO_MANY,
            'related' => \App\Models\Role::class,
            'name' => 'model',
            'table' => 'model_has_roles',
            'foreignPivotKey' => 'model_id',
            'relatedPivotKey' => 'role_id'
        ],
        'permissions' => [
            self::MORPH_TO_MANY,
            'related' => \App\Models\Permission::class,
            'name' => 'model',
            'table' => 'model_has_permissions',
            'foreignPivotKey' => 'model_id',
            'permission_id'
        ]
//        'cliente' => [self::BELONGS_TO, 'related' => 'App\Models\Cliente'],
//        'tickets' => [self::HAS_MANY, 'related' => 'App\Models\Ticket'],
    ];

    public function getFenameAttribute() {
        if (!$this->getKey()) {
            return "N.D.";
        }
        if ($this->nome) {
            return trim($this->nome . ' ' . $this->cognome);
        }

        return $this->name ?: $this->email;
    }

    public function getInfoAttribute($value)
    {
        $value = json_decode($value, true);
        if (!is_array($value)) {
            return [];
        }
        return $value;
    }

    public function sendEmailVerificationNotification()
    {
        if ($this->hasRole('Studente')) {
            $role = 'Studente';
        } else {
            $role = 'Scuola';
        }
        $this->notify(new VerifyEmail($role));
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function sendRegistrazioneStudenteNotification()
    {
        $this->notify(new RegistrazioneStudente());
    }

    public function sendCandidaturaInviataNotification($candidato)
    {
        $this->notify(new CandidaturaInviata($candidato));
    }

    public function sendCandidaturaApprovataNotification($candidato)
    {
//        $this->notify(new CandidaturaApprovata($candidato));
    }

    public function getCodiceFiscaleAttribute() {
        $userInfo = $this->info;
        return Arr::first(Arr::get($userInfo,'spidFiscalNumber',[]));
    }
}
