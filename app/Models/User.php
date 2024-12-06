<?php

namespace App\Models;

use Gecche\Cupparis\App\Models\User as CupparisUser;

use Laravel\Sanctum\HasApiTokens;

class User extends CupparisUser {
	use Relations\UserRelations;

    use HasApiTokens;


    public $appends = [
        'mainrole',
        'fename',
    ];

    protected $fillable = [
        'name', 'email', 'password',
        'nome', 'cognome', 'email_verified_at',
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
}
