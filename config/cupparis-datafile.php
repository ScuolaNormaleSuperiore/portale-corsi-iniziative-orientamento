<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Cupparis Datafile
      |--------------------------------------------------------------------------
      |
      |
     */

    'providers' => [
        'dscuola' => \App\DatafileProviders\Scuola::class,
        'dscuolaparitaria' => \App\DatafileProviders\ScuolaParitaria::class,
    ]

];

