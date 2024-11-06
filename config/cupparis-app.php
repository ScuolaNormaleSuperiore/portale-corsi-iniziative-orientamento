<?php

return [

    'controllers-namespace' => "Gecche\\Cupparis\\App\\Http\\Controllers",

    /*
    |--------------------------------------------------------------------------
    | Uploads types and settings
    |--------------------------------------------------------------------------
    |
    |
    */

    'uploads' => [
        'foto' => [
            'max_size' => 2000,
            'exts' => 'jpeg,jpg,png',
        ],
        'attachment' => [
            'max_size' => 10000,
            'exts' => 'pdf,zip,rar,doc,docx,xls,xlsx,ppt,pptx,odf,ods,txt,csv',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Json error messages
    |--------------------------------------------------------------------------
    |
    |
    */

    'array_to_string' => true,
    'separator' => '<br/>',

    /*
     *
     */
    'foorm' => [
        'entities' => [
            "user",
            "dcomune",
            // "cup_geo_continente",
            // "cup_geo_area_mondiale",
            // "cup_geo_nazione",
            // "cup_geo_area",
            // "cup_geo_regione",
            // "cup_geo_provincia",
            // "cup_geo_comune",
            // "cup_geo_nazioni_istat",
            // "cup_geo_comuni_istat",
            // "cup_geo_comuni_aggiuntive",
            // "cup_anag_anagrafica",
            // "cup_anag_natura_giuridica",
            // "cup_anag_professione",
            // "cup_anag_stato_civile",
            // "cup_anag_contatto",
            // "cup_anag_tipologia_indirizzo",
            // "cup_anag_indirizzo",
            // "cup_anag_tipologia_anagrafica",
            // "cup_anag_tipologia_affiliazione",
            // "cup_anag_sede",
            // "cup_anag_affiliazione",
            // "cup_anag_storico_affiliazione",
            // "cup_cont_traits",
            // "cup_cont_costante_fatt_el",
            // "cup_cont_tipologia_documento",
            // "cup_cont_iva",
            // "cup_cont_forma_pagamento",
            // "cup_cont_tipologia_prestazione",
            // "cup_cont_progressivo",
            // "cup_cont_prestazione",
            // "cup_cont_documento",
            // "cup_cont_registrazione",
            // "cup_cont_documento_riga",
            // "cup_cont_documento_riga_iva",
        ]
    ]
];
