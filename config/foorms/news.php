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
            "data" => [

            ],
            "titolo_it" => [

            ],
            "sottotitolo_it" => [

            ],
            "slug_it" => [

            ],
            "evidenza" => [

            ],
            "attivo" => [

            ],
            "id" => [

            ]
        ],
    ],
    'search' => [
        'fields' => [
            "data" => [

            ],
            "titolo_it" => [
                "operator" => "like"
            ],
            "sottotitolo_it" => [
                "operator" => "like"
            ],
            "slug_it" => [
                "operator" => "like"
            ],
            "evidenza" => [

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

        'basic_query_fields' => ['titolo_it','sottotitolo_it'],
        'actions' => [
            'set' => [
                'allowed_fields' => [
                    'attivo',
                    'evidenza',
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
            "data" => [

            ],
            "titolo_it" => [

            ],
            "sottotitolo_it" => [

            ],
            "slug_it" => [

            ],
            "evidenza" => [
                "options" => "method",
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

        ],
        'params' => [

        ],
    ],
    'edit' => [

        'actions' => [
            'uploadfile' => [
                'allowed_fields' => [
                    'attachments|resource',
                    'fotos|resource',
                ],
                'fields' => [
                    'attachments|resource' => [
                        'resource_type' => 'attachment',
                        //'max_size' => '4M',
                        'exts' => 'pdf,doc,docx,zip',
                    ],
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
            "data" => [

            ],
            "titolo_it" => [

            ],
            "sottotitolo_it" => [

            ],
            "slug_it" => [

            ],
            "evidenza" => [
                "options" => "method",
            ],
            "attivo" => [
                "options" => "boolean",
            ],
            "id" => [

            ]
        ],
        'relations' => [
            "attachments" => [
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
            ],
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
            ],
            "sezioni" => [
                "fields" => [
                    'id' => [],
                    'nome_it' => [],
                    'contenuto_it' => [],
                    'ordine' => [],
                ],
                'orderKey' => 'ordine',
            ],
        ],
        'params' => [

        ],
    ],
//    'insert' => [
//
//    ],

];
