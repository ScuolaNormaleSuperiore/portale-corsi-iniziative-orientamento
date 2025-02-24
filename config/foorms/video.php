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
            "titolo_it" => [

            ],
            "descrizione_it" => [

            ],
            "tipo" => [

            ],
            "video_id" => [

            ],
            "attivo" => [

            ],
            "ordine" => [

            ],
            "homepage" => [

            ],
            "slug_it" => [

            ],
            "materia_id" => [

            ],
            "id" => [

            ]
        ],
    ],
    'search' => [
        'fields' => [
            "titolo_it" => [
                "operator" => "like"
            ],
            "descrizione_it" => [
                "operator" => "like"
            ],
            "autore" => [
                "operator" => "like"
            ],
            "tipo" => [
                "operator" => "=",
                "options" => "dboptions"
            ],
            "video_id" => [
                "operator" => "like"
            ],
            "attivo" => [
                "operator" => "=",
                "options" => "boolean"
            ],
            "ordine" => [
//                "options" => "method"
            ],
            "homepage" => [
                "operator" => "=",
                "options" => "boolean"
            ],
            "slug_it" => [
                "operator" => "like"
            ],
            "materia_id" => [
                "operator" => "=",
                "options" => "relation:categoria"
            ],
            "id" => [

            ]
        ],
    ],
    'list' => [

        'basic_query_fields' => ['titolo_it'],
        'actions' => [
            'set' => [
                'allowed_fields' => [
                    'attivo',
                    'homepage',
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
            "titolo_it" => [

            ],
            "descrizione_it" => [

            ],
            "autore" => [

            ],
            "tipo" => [

            ],
            "video_id" => [

            ],
            "attivo" => [

            ],
            "ordine" => [
                "options" => "method"
            ],
            "homepage" => [

            ],
            "slug_it" => [

            ],
            "materia_id" => [

            ],
            "id" => [

            ],
            "picture" => [

            ],
        ],
        'relations' => [
            "categoria" => [
                "fields" => [
                    "nome_it" => [],
                ]
            ]
        ],
        'params' => [

        ],
    ],
    'edit' => [
        'fields' => [
            "id" => [

            ],
            "titolo_it" => [

            ],
            "descrizione_it" => [

            ],
            "autore" => [

            ],
            "tipo" => [

            ],
            "video_id" => [

            ],
            "ordine" => [
                "options" => "method",
            ],
            "attivo" => [
                "options" => "boolean",
                "nulloption" => false,
                "default" => 0,
            ],
            "homepage" => [
                "options" => "boolean",
                "nulloption" => false,
                "default" => 0,
            ],
            "slug_it" => [

            ],
            "materia_id" => [
                "options" => "relation:categoria"
            ],
            "id" => [

            ]
        ],
        'relations' => [
            "categoria" => [
                "fields" => [

                ],
                "savetype" => [

                ]
            ]
        ],
        'params' => [

        ],
    ],
//    'insert' => [
//
//    ],

];
