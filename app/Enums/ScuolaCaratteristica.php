<?php

namespace App\Enums;

use Gecche\FSM\Contracts\FSMConfigInterface;
use Illuminate\Support\Arr;

enum ScuolaCaratteristica: string
{
    use EnumHelperTrait;

    case ISOLANO = 'ISOLANO';
    case NORMALE = 'NORMALE';
    case CONVITTO_NAZIONALE = 'CONVITTO NAZIONALE';
    case ANNESSO_A_CONVITTO = 'ANNESSO A CONVITTO';
    case CONVITTO_ANNESSO = 'CONVITTO ANNESSO';
    case PERCORSO_II_LIVELLO = 'PERCORSO II LIVELLO';
    case SPEC_PER_CARCERARI = 'SPEC. PER CARCERARI';
    case CO_IST_OSPEDALIERO = 'C/O IST. OSPEDALIERO';
    case SCUOLA_ANNESSA = 'SCUOLA ANNESSA';
    case SLOVENO = 'SLOVENO';
    case ANN_A_EDUCANDATO = 'ANN. A EDUCANDATO';
    case PER_SORDOMUTI = 'PER SORDOMUTI';
    case PER_CIECHI = 'PER CIECHI';
    case EDUCANDATO_FEMMINILE = 'EDUCANDATO FEMMINILE';
    case SPEC_PER_SORDOMUTI = 'SPEC. PER SORDOMUTI';


    public static function getLangKey($case)
    {
        return 'enums.statuses.scuola_caratteristica.' . $case->value;
    }

}

// see https://emekambah.medium.com/php-enum-and-use-cases-in-laravel-ac015cf181ad
