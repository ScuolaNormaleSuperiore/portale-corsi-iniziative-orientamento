<?php

use App\Enums\CandidatoStatuses;

return [

    'sesso' => ['M' => 'M','F' => 'F','A' => 'A'],

    'candidato' => [
        'statuses' => [
            'colors' => [
                CandidatoStatuses::BOZZA->value => env('COLOR_BOZZA_STATUS','#5d7083'), //'#5d7083'),
                CandidatoStatuses::INVIATA->value => env('COLOR_INVIATA_STATUS','#01a7d5'), //'#005a73'),
                CandidatoStatuses::APPROVATA->value => env('COLOR_APPROVATA_STATUS','#019966'), //'#008055'),
                CandidatoStatuses::RIFIUTATA->value => env('COLOR_RIFIUTATA_STATUS','#e52949'), //'#cc334d'),
                CandidatoStatuses::LISTA_ATTESA->value => env('COLOR_LISTA_ATTESA_STATUS','#db8402'), //'#995c00'),
            ]
        ]
    ],
];
