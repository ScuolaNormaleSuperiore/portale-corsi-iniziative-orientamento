<?php

namespace App\Models;

use Gecche\Cupparis\App\Models\User as CupparisUser;

use Laravel\Sanctum\HasApiTokens;

class User extends CupparisUser {
    use HasApiTokens;


    public $appends = [
        'mainrole',
        'fename',
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
