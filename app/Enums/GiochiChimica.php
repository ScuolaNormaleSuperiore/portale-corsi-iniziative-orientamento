<?php

namespace App\Enums;

use Gecche\FSM\Contracts\FSMConfigInterface;
use Illuminate\Support\Arr;

enum GiochiChimica: string
{
    use EnumHelperTrait;

    case NESSUNA_PARTECIPAZIONE = 'nessuna_partecipazione';
//    case VALIDATION = 'validation';
//    case REFERENT_REJECTED = 'referent_rejected';
    case SELEZIONI_ISTITUTO = 'selezioni_di_istituto';
    case FINALI_REGIONALI = 'finali_regionali';
    case FINALE_NAZIONALE = 'finale_nazionale';

    public static function getLangKey($case)
    {
        return 'enums.statuses.giochi_chimica.' . $case->value;
    }

}

// see https://emekambah.medium.com/php-enum-and-use-cases-in-laravel-ac015cf181ad

/*


Giochi della Chimica

Individuali: menu a tendina con le seguenti scelte

nessuna partecipazione

selezioni di istituto

finali regionali

finale nazionale

Olimpiadi di Informatica

Individuali: menu a tendina con le seguenti scelte

nessuna partecipazione

prima fase (selezione scolastica)

seconda fase (selezione territoriale)

terza fase (selezione nazionale)


Stages: elenco di caselle da spuntare con le seguenti opzioni

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
