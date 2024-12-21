<?php

namespace App\Enums;

use Gecche\FSM\Contracts\FSMConfigInterface;
use Illuminate\Support\Arr;

enum Stages: string
{
    use EnumHelperTrait;

    case SCIENZIATE_DOMANI = 'scienziate_domani';
    case STAGE_FISICA_PISA_NORMALE = 'stage_fisica_pisa_normale';
    case STAGE_CHIMICA_PISA_NORMALE = 'stage_chimica_pisa_normale';
    case STAGE_BIOLOGIA_PISA_NORMALE = 'stage_biologia_pisa_normale';
    case EGMO_CAMP = 'egmo_camp';
    case WINTER_CAMP_PISA_MATEMATICA = 'winter_camp_pisa_matematica';
    case STAGE_SENIOR_PISA_MATEMATICA = 'stage_senior_pisa_matematica';
    case STAGE_PREIMO_PISA_MATEMATICA = 'stage_preimo_pisa_matematica';
    case NORMALE_ANCHE_TU = 'normale_anche_tu';
    case ALTRO_ORIENTAMENTO = 'altro_orientamento';

    public static function getLangKey($case)
    {
        return 'enums.statuses.stages.' . $case->value;
    }

}

// see https://emekambah.medium.com/php-enum-and-use-cases-in-laravel-ac015cf181ad

/*



Scienziate di domani

Stage di Fisica a Pisa, organizzato da allieve/i della Scuola Normale

Stage di Chimica a Pisa, organizzato da allieve/i della Scuola Normale

Stage di Biologia a Pisa, organizzato da allieve/i della Scuola Normale

EGMO Camp

Winter Camp a Pisa (matematica)

Stage Senior a Pisa (matematica)

Stage PreIMO a Pisa (matematica)

Alla Normale anche tu
Altre iniziative di orientamento della Scuola Normale
Gare internazionali: elenco di caselle da spuntare con le seguenti opzioni

EGMO (European Girls' Mathematical Olympiad)

BMO (Balkan Mathematical Olympiad)

RMM (Romanian Master of Mathematics)

IMO (International Mathematical Olympiad)

IPhO (International Physics Olympiad)

EuPhO (European Physics Olympiad)

IChO (International Chemistry Olympiad)

IBO (International Biology Olympiad)

IESO (International Earth Science Olympiad)

 */
