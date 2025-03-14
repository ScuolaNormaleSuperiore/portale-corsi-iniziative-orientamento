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
            "email" => [

            ],
            "scuola_id" => [

            ],
            "nome" => [

            ],
            "cognome" => [

            ],
            "telefono" => [

            ],
            "note" => [

            ],
            "approvata" => [

            ],
            "id" => [

            ]
        ],
    ],
    'search' => [
        'fields' => [
            "email" => [
                "operator" => "like"
            ],
            "scuola_id" => [
                "operator" => "=",
                "options" => "relation:scuola"
            ],
            "nome" => [
                "operator" => "like"
            ],
            "cognome" => [
                "operator" => "like"
            ],
            "telefono" => [
                "operator" => "like"
            ],
            "note" => [

            ],
            "approvata" => [
                "operator" => "=",
                "options" => "boolean"
            ],
            "id" => [

            ]
        ],
    ],
    'list' => [

        'basic_query_fields' => ['email','scuola|denominazione'],
        'actions' => [
            'set' => [
                'allowed_fields' => [
                    'approvata',
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
            "email" => [

            ],
            "scuola_id" => [

            ],
            "nome" => [

            ],
            "cognome" => [

            ],
            "telefono" => [

            ],
            "note" => [

            ],
            "approvata" => [

            ],
            "id" => [

            ]
        ],
        'relations' => [
            "scuola" => [
                "fields" => [
                    'denominazione' => [],
                    'codice' => [],
                    'provincia_sigla' => [],
                    'email_riferimento' => [],
                ]
            ]
        ],
        'params' => [

        ],
    ],
    'edit' => [
        'fields' => [
            "email" => [

            ],
            "scuola_id" => [

            ],
            "nome" => [

            ],
            "cognome" => [

            ],
            "telefono" => [

            ],
            "note" => [

            ],
            "approvata" => [

            ],
            "id" => [

            ]
        ],
        'relations' => [
            "scuola" => [
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
