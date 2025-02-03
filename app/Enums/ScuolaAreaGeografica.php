<?php

namespace App\Enums;

use Gecche\FSM\Contracts\FSMConfigInterface;
use Illuminate\Support\Arr;

enum ScuolaAreaGeografica: string
{
    use EnumHelperTrait;

    case NORD = 'NORD OVEST';
    case SUD = 'SUD';
    case NORD_EST = 'NORD EST';
    case CENTRO = 'CENTRO';
    case ISOLE = 'ISOLE';


    public static function getLangKey($case)
    {
        return 'enums.statuses.scuola_area_geografica.' . $case->value;
    }

}

// see https://emekambah.medium.com/php-enum-and-use-cases-in-laravel-ac015cf181ad
