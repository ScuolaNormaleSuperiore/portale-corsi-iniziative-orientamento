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

    'view' => [
        'fields' => [
            "materia_id" => [

            ],
            "nome" => [

            ],
            "cognome" => [

            ],
            "descrizione_it" => [

            ],
            "link" => [

            ],
            "attivo" => [

            ],
            "id" => [

            ]
        ],
    ],
    'search' => [
        'fields' => [
            "materia_id" => [
                "operator" => "=",
                "options" => "relation:materia"
            ],
            "nome" => [
                "operator" => "like"
            ],
            "cognome" => [
                "operator" => "like"
            ],
            "descrizione_it" => [

            ],
            "link" => [
                "operator" => "like"
            ],
            "attivo" => [
                "operator" => "=",
                "options" => "boolean"
            ],
            "id" => [

            ]
        ],
    ],
    'list' => [

        'actions' => [
            'set' => [
                'allowed_fields' => [
                    'attivo',
                ],
            ],
        ],
        'dependencies' => [
            'search' => 'search',
        ],

        'pagination' => [
            'per_page' => 20,
            'pagination_steps' => [10, 20, 50],
        ],

        'fields' => [
            "materia_id" => [

            ],
            "nome" => [

            ],
            "cognome" => [

            ],
            "descrizione_it" => [

            ],
            "link" => [

            ],
            "attivo" => [

            ],
            "id" => [

            ],"picture" => [

            ],
        ],
        'appends' => [
            "picture",
        ],
        'relations' => [
            "materia" => [
                "fields" => [
                    "nome_it" => []

                ]
            ]
        ],
        'params' => [

        ],
    ],
    'edit' => [
        'actions' => [
            'uploadfile' => [
                'allowed_fields' => [
                    'fotos|resource',
                ],
                'fields' => [
                    'fotos|resource' => [
                        'resource_type' => 'foto',
                        //'max_size' => '4M',
                        'exts' => 'jpg,png',
                    ],
//                'thumb_url_file' => [
//                    'resource_type' => 'foto',
//                    //'max_size' => '4M',
//                    'exts' => 'png,jpg',
//                ],
                ],
            ],
        ],
        'fields' => [
            "materia_id" => [
                "options" => "relation:materia"
            ],
            "nome" => [

            ],
            "cognome" => [

            ],
            "descrizione_it" => [

            ],
            "link" => [

            ],
            "attivo" => [
                "options" => "boolean",
                "nulloption" => false,
                "default" => 0,
            ],
            "slug_it" => [

            ],
            "id" => [

            ]
        ],
        'relations' => [
            "fotos" => [
                "fields" => [
                    'id' => [],
                    'nome' => [],
                    'descrizione' => [],
                    'resource' => [],
                    'ordine' => [],
                ],
                'orderKey' => 'ordine',

                'beforeNewCallbackMethods' => ['setFieldsFromResource'],
                'beforeUpdateCallbackMethods' => ['setFieldsFromResource'],
                'afterNewCallbackMethods' => ['filesOps'],
                'afterUpdateCallbackMethods' => ['filesOps'],
            ]
        ],
        'params' => [

        ],
    ],
//    'insert' => [
//
//    ],

];
