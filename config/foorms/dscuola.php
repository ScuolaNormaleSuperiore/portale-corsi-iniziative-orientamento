<?php


/*
 * 'model' => <MODELNAME>
 * <FORMNAME> =>  [ //nome del form da route
 *      type => <FORMTYPE>, //tipo di form (opzionale se non c'è viene utilizzato il nome)
 *              //search, list, edit, insert, view, csv, pdf
 *      fields => [ //i campi del modello principale
 *          <FIELDNAME> => [
 *              'default' => <DEFAULTVALUE> //valore di default del campo (null se non presente)
 *              'options' => array|relation:<RELATIONNAME>:<COLUMNS>|dboptions|boolean
 *                          //le opzioni possibili di un campo, prese da un array associativo,
 *                              da una relazione (gli id del modello correlato
 *                              con <COLUMNS> serie di campi separati da virgola da inviare,
 *                              dal database (enum ecc...)
 *                              booleano
 *              'nulloption' => true|false|onchoice //onchoice indica che l'opzione nullable è presente solo se i valori
 *                                  delle options sono più di uno; default: true,
 *          ]
 *      ],
 *      relations => [ // le relazioni del modello principale
 *          <RELATIONNAME> => [
 *              fields => [ //i campi del modello principale
 *                  <FIELDNAME> => [
 *                      'default' => <DEFAULTVALUE> //valore di default del campo (null se non presente)
 *                      'options' => array|relation:<RELATIONNAME>|dboptions|boolean
 *                          //le opzioni possibili di un campo, prese da un array associativo,
 *                              da una relazione (gli id del modello correlato,
 *                              dal database (enum ecc...)
 *                              booleano
 *                      'nulloption' => true|false|onchoice //onchoice indica che l'opzione nullable è presente solo se i valori
 *                                    delle options sono più di uno; default: true,
 *                  ]
 *              ],
 *              savetype => [ //metodo di salvataggio della relazione
 *                              (in caso di edit/insert) da definire meglio
 *              ]
 *          ]
 *      ],
 *      params => [ // altri parametri opzionali
 *
 *      ],
 * ]
 */

return [

    'search' => [
        'model' => 'scuola',
        'models_namespace' => "App\\DatafileModels\\",
    ],
    'list' => [
        'model' => 'scuola',
        'models_namespace' => "App\\DatafileModels\\",

        'pagination' => [
            'per_page' => 20,
            'pagination_steps' => [10, 25, 50, 300],
        ],

        'allowed_actions' => [
//            'excel-export' => true,
        ],

        'actions' => [
//            'excel-export' => [
//                'default' => [
////                    'blacklist' => [
//////                        'password'
////                    ],
//                    'whitelist' => [
//                        'codice',
//                        'descrizione',
//                        'um',
//                        'prezzo',
//                        'mdo',
//                        'noli',
//                        'mt',
//
//                        'computo_percentuale',
//                        'computo_quantita',
//                        'computo_importo',
//
//                ],
//                    'fieldsParams' => [
////                        "istituto|comunenome" => [
////                            'header' => 'Istituto - comune (nome)',
////                            'item' => 'istituto|T_COMUNE_ID',
////                        ],
//                    ],
//                    'separator' => ';',
//                    'endline' => "\n",
//                    'headers' => 'translate',
//                    'decimalFrom' => '.',
//                    'decimalTo' => false,
//                ],
//            ]


        ],
        'fields' => [

            'datafile_sheet' => [],
            'row' => [],

            'ANNOSCOLASTICO' => [],
            'AREAGEOGRAFICA' => [],
            'REGIONE' => [],
            'PROVINCIA' => [],
            'CODICEISTITUTORIFERIMENTO' => [],
            'DENOMINAZIONEISTITUTORIFERIMENTO' => [],
            'CODICESCUOLA' => [],
            'DENOMINAZIONESCUOLA' => [],
            'INDIRIZZOSCUOLA' => [],
            'CAPSCUOLA' => [],
            'CODICECOMUNESCUOLA' => [],
            'DESCRIZIONECOMUNE' => [],
            'DESCRIZIONECARATTERISTICASCUOLA' => [],
            'DESCRIZIONETIPOLOGIAGRADOISTRUZIONESCUOLA' => [],
            'INDICAZIONESEDEDIRETTIVO' => [],
            'INDICAZIONESEDEOMNICOMPRENSIVO' => [],
            'INDIRIZZOEMAILSCUOLA' => [],
            'INDIRIZZOPECSCUOLA' => [],
            'SITOWEBSCUOLA' => [],
            'SEDESCOLASTICA' => [],

        ],
        'relations' => [
            'errors' => [
                'fields' => [
                    'id' => [

                    ],
                    'field_name' => [
                    ],
                    'error_name' => [
                    ],
                    'row' => [
                    ],
                    'type' => [
                    ],
                    'value' => [
                    ],
                    'param' => [
                    ],
                ],

            ],
        ],
        'params' => [

        ],
    ],
    'edit' => [
        'model' => 'scuola',
        'models_namespace' => "App\\DatafileModels\\",
        "actions" => [
            'uploadfile' => [
                'allowed_fields' => [
                    'resource',
                ],
                'fields' => [
                    'resource' => [
                        'resource_type' => 'attachment',
                        'exts' => ['csv', 'txt'],
                    ],
                ],
            ],
        ],
        'fields' => [
            'id' => [

            ],
//            'currency_from' => [
//
//            ],
//            'currency_to' => [
//
//            ],
//            'giorni' => [
//                'options' => [
//                    '1' => 'lun',
//                    '2' => 'mar',
//                    '3' => 'mer',
//                    '4' => 'gio',
//                    '5' => 'ven',
//                    '6' => 'sab',
//                    '7' => 'dom',
//                ],
//                'nulloption' => false,
//                'default' => [],
//            ],
            'resource' => [
                'resource_type' => 'attachment',
            ]

//            'username' => [
//                //'default' => 'user'
//            ],
//            'cliente_id' => [
//                'nullable' => true,
//                'options' => 'relation:cliente',
//            ],
//            'attivo' => [
//                'options' => 'boolean',
//            ],
        ],
//        'relations' => [
//            'tickets' => [
//                'fields' => [
//                    'id' => [
//
//                    ],
//                    'codice' => [
//                        'nullable' => true,
//                        'options' => 'relation:cliente',
//                        //'default' => 'pippo',
//                    ],
//                    'descrizione' => [
//
//                    ],
//                ],
//
//            ],
//        ],
        'params' => [

        ],
    ],
//    'insert' => [
//
//    ],

];
