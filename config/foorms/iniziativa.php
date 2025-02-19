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
            "anno" => [

            ],
            "titolo" => [

            ],
            "descrizione" => [

            ],
            "data_apertura" => [

            ],
            "data_chiusura" => [

            ],
            "modalita_candidatura" => [

            ],
            "attivo" => [

            ],
            "id" => [

            ],
            "dati_statistici" => [

            ],
        ],
        'appends' => [
            'dati_statistici',
        ]
    ],
    'search' => [
        'fields' => [
            "anno" => [

            ],
            "titolo" => [
                "operator" => "like"
            ],
            "descrizione" => [

            ],
            "data_apertura" => [

            ],
            "data_chiusura" => [

            ],
            "modalita_candidatura" => [
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

        'basic_query_fields' => ['titolo'],
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
            "anno" => [
            ],
            "titolo" => [

            ],
            "descrizione" => [

            ],
            "data_apertura" => [

            ],
            "data_chiusura" => [

            ],
            "posti" => [

            ],
            "posti_onere" => [

            ],
            "note" => [

            ],
            "modalita_candidatura" => [

            ],
            "max_candidature_scuola" => [

            ],
            "attivo" => [

            ],
            "id" => [

            ],
        ],
        'appends' => [

        ],
        'relations' => [

        ],
        'params' => [

        ],
    ],
    'edit' => [
        'fields' => [
            "anno" => [
                'options' => 'method',
                'default' => date('Y'),
            ],
            "titolo" => [

            ],
            "descrizione" => [

            ],
            "data_apertura" => [

            ],
            "data_chiusura" => [

            ],
            "modalita_candidatura" => [
                'options' => 'method',
            ],
            "attivo" => [
                'options' => 'boolean',
                'nulloption' => false,

            ],
            "posti" => [

            ],
            "posti_onere" => [

            ],
            "max_candidature_scuola" => [

            ],
            "note" => [

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
        ],
        'params' => [

        ],
    ],
//    'insert' => [
//
//    ],

];
