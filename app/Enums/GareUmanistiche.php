<?php

namespace App\Enums;

use Gecche\FSM\Contracts\FSMConfigInterface;
use Illuminate\Support\Arr;

enum GareUmanistiche: string
{
    use EnumHelperTrait;


case CAMPIONATI_ITALIANO = 'camp_italiano';
case CAMPIONATI_LINGUE_CIVILTA_CLASSICHE = 'camp_lingue_civilta_classiche';
case CAMPIONATO_NAZIONALE_LINGUE = 'camp_naz_lingue';
case CERTAMEN_CICERONIANUM_ARPINAS = 'certamen_ciceronianum_arpinas';
case CERTAMEN_LATINUM__TANTUCCI_TRIENNIO = 'certamen_latinum_tantucci_triennio';
case CAMPIONATI_DI_FILOSOFIA = 'camp_filosofia';
case ROMANAE_DISPUTATIONES = 'romanae_disputationes';

    public static function getLangKey($case)
    {
        return 'enums.statuses.gare_umanistiche.' . $case->value;
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
