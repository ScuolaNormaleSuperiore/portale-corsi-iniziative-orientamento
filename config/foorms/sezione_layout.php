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
            "codice" => [

            ],
            "nome" => [

            ],
            "tipo" => [

            ],
            "testo_it" => [

            ],
            "id" => [

            ]
        ],
    ],
    'search' => [
        'fields' => [
            "codice" => [
                "operator" => "like"
            ],
            "nome" => [
                "operator" => "like"
            ],
            "tipo" => [
                "operator" => "like"
            ],
            "testo_it" => [
                "operator" => "like"
            ],
            "id" => [

            ]
        ],
    ],
    'list' => [

        'dependencies' => [
            'search' => 'search',
        ],

        'pagination' => [
            'per_page' => 20,
            'pagination_steps' => [10, 20, 50],
        ],

        'fields' => [
            "id" => [

            ],
            "codice" => [

            ],
            "nome" => [

            ],
            "tipo" => [

            ],
            "testo_it" => [

            ],
            "id" => [

            ]
        ],
        'relations' => [

        ],
        'params' => [

        ],
    ],
    'edit' => [
        'fields' => [
            "id" => [

            ],
            "codice" => [

            ],
            "nome" => [

            ],
            "tipo" => [

            ],
            "testo_it" => [

            ],
            "id" => [

            ]
        ],
        'relations' => [

        ],
        'params' => [

        ],
    ],
//    'insert' => [
//
//    ],

];
