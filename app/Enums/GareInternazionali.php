<?php

namespace App\Enums;

use Gecche\FSM\Contracts\FSMConfigInterface;
use Illuminate\Support\Arr;

enum GareInternazionali: string
{
    use EnumHelperTrait;

    case EGMO = 'EGMO';
    case BMO = 'BMO';
    case RMM = 'RMM';
    case IMO = 'IMO';
    case IPhO = 'IPhO';
    case EuPhO = 'EuPhO';
    case IChO = 'IChO';
    case IBO = 'IBO';
    case IESO = 'IESO';

    public static function getLangKey($case)
    {
        return 'enums.statuses.gare_internazionali.' . $case->value;
    }

}

// see https://emekambah.medium.com/php-enum-and-use-cases-in-laravel-ac015cf181ad

/*




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
