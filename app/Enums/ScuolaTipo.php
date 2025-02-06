<?php

namespace App\Enums;

use Gecche\FSM\Contracts\FSMConfigInterface;
use Illuminate\Support\Arr;

enum ScuolaTipo: string
{
    use EnumHelperTrait;


case PUBBLICA = "pubblica";
case PARITARIA = "paritaria";

    public static function getLangKey($case)
    {
        return 'enums.statuses.scuola_tipo.' . $case->value;
    }

}

// see https://emekambah.medium.com/php-enum-and-use-cases-in-laravel-ac015cf181ad
