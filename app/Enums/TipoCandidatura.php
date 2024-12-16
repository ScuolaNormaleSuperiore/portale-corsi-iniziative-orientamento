<?php

namespace App\Enums;

use Gecche\FSM\Contracts\FSMConfigInterface;
use Illuminate\Support\Arr;

enum TipoCandidatura: string
{
    use EnumHelperTrait;

    case SCUOLA = 'scuola';
//    case VALIDATION = 'validation';
//    case REFERENT_REJECTED = 'referent_rejected';
    case ALTRO = 'altro';
    case STUDENTE = 'studente';
    public static function getLangKey($case)
    {
        return 'enums.statuses.tipo_candidatura.' . $case->value;
    }

}

// see https://emekambah.medium.com/php-enum-and-use-cases-in-laravel-ac015cf181ad
