<?php

namespace App\Enums;

use Gecche\FSM\Contracts\FSMConfigInterface;
use Illuminate\Support\Arr;

enum OlimpiadiFisica: string
{
    use EnumHelperTrait;

    case NESSUNA_PARTECIPAZIONE = 'nessuna_partecipazione';
//    case VALIDATION = 'validation';
//    case REFERENT_REJECTED = 'referent_rejected';
    case PRIMO_LIVELLO = 'primo_livello';
    case SECONDO_LIVELLO = 'secondo_livello';
    case FINALE_NAZIONALE = 'finale_nazionale';

    public static function getLangKey($case)
    {
        return 'enums.statuses.olimpiadi_fisica.' . $case->value;
    }

}

// see https://emekambah.medium.com/php-enum-and-use-cases-in-laravel-ac015cf181ad
