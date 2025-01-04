<?php

namespace App\Enums;

use Gecche\FSM\Contracts\FSMConfigInterface;
use Illuminate\Support\Arr;

enum CandidatoStatuses: string implements FSMConfigInterface
{
    use EnumHelperTrait;

    case BOZZA = 'bozza';
//    case VALIDATION = 'validation';
//    case REFERENT_REJECTED = 'referent_rejected';
    case INVIATA = 'inviata';
    case APPROVATA = 'approvata';
    case RIFIUTATA = 'rifiutata';

    public static function getLangKey($case)
    {
        return 'enums.statuses.candidato.' . $case->value;
    }

    public static function states()
    {

        $states = array_fill_keys(static::values(), []);


        return $states;

    }

    public static function groups()
    {
        /*
            Groups structure
            [
                    groupcode => description|null
            ]
                 */
        return [
        ];

    }

    public static function root()
    {
        return self::BOZZA->value;
    }

    public static function transitions()
    {
        /*
         Transitions structure
        [
            <statecode> => [
                <statescode1>,..,<statecodeN>
            ],
        ]
        */
        return [

            self::BOZZA->value => [
                self::INVIATA->value,
            ],
            self::INVIATA->value => [
                self::APPROVATA->value,
                self::RIFIUTATA->value,
                self::BOZZA->value,
            ],
            self::RIFIUTATA->value => [
                self::INVIATA->value,
            ],
            self::APPROVATA->value => [
                self::INVIATA->value,
            ],

        ];
    }

}

// see https://emekambah.medium.com/php-enum-and-use-cases-in-laravel-ac015cf181ad
