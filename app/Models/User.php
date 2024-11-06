<?php

namespace App\Models;

use Gecche\Cupparis\App\Models\User as CupparisUser;

use Laravel\Sanctum\HasApiTokens;

class User extends CupparisUser {
    use HasApiTokens;
}
