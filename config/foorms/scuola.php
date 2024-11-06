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
            "area_geografica" => [

            ],
            "regione_id" => [

            ],
            "provincia_id" => [

            ],
            "codice_istituto_riferimento" => [

            ],
            "denominazione_istituto_riferimento" => [

            ],
            "codice" => [

            ],
            "denominazione" => [

            ],
            "indirizzo" => [

            ],
            "cap" => [

            ],
            "catastale_comune" => [

            ],
            "comune" => [

            ],
            "caratteristica" => [

            ],
            "tipologia_grado_istruzione" => [

            ],
            "indicazione_sede_direttivo" => [

            ],
            "indicazione_sede_omnicomprensivo" => [

            ],
            "email" => [

            ],
            "pec" => [

            ],
            "web" => [

            ],
            "sede_scolastica" => [

            ],
            "email_riferimento" => [

            ],
            "user_id" => [

            ],
            "id" => [

            ]
        ],
    ],
    'search' => [
        'fields' => [
            "anno" => [

            ],
            "area_geografica" => [
                "operator" => "like"
            ],
            "regione_id" => [
                "operator" => "=",
                "options" => "relation:regione"
            ],
            "provincia_id" => [
                "operator" => "=",
                "options" => "relation:provincia"
            ],
            "codice_istituto_riferimento" => [
                "operator" => "like"
            ],
            "denominazione_istituto_riferimento" => [
                "operator" => "like"
            ],
            "codice" => [
                "operator" => "like"
            ],
            "denominazione" => [
                "operator" => "like"
            ],
            "indirizzo" => [
                "operator" => "like"
            ],
            "cap" => [
                "operator" => "like"
            ],
            "catastale_comune" => [
                "operator" => "like"
            ],
            "comune" => [
                "operator" => "like"
            ],
            "caratteristica" => [
                "operator" => "like"
            ],
            "tipologia_grado_istruzione" => [
                "operator" => "like"
            ],
            "indicazione_sede_direttivo" => [
                "operator" => "=",
                "options" => "boolean"
            ],
            "indicazione_sede_omnicomprensivo" => [
                "operator" => "like"
            ],
            "email" => [
                "operator" => "like"
            ],
            "pec" => [
                "operator" => "like"
            ],
            "web" => [
                "operator" => "like"
            ],
            "sede_scolastica" => [
                "operator" => "=",
                "options" => "boolean"
            ],
            "email_riferimento" => [
                "operator" => "like"
            ],
            "user_id" => [
                "operator" => "=",
                "options" => "relation:user"
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
            "anno" => [

            ],
            "area_geografica" => [
                'options' => 'method',
            ],
            "regione_id" => [

            ],
            "provincia_id" => [

            ],
            "codice_istituto_riferimento" => [

            ],
            "denominazione_istituto_riferimento" => [

            ],
            "codice" => [

            ],
            "denominazione" => [

            ],
            "indirizzo" => [

            ],
            "cap" => [

            ],
            "catastale_comune" => [

            ],
            "comune" => [

            ],
            "caratteristica" => [

            ],
            "tipologia_grado_istruzione" => [

            ],
            "indicazione_sede_direttivo" => [

            ],
            "indicazione_sede_omnicomprensivo" => [

            ],
            "email" => [

            ],
            "pec" => [

            ],
            "web" => [

            ],
            "sede_scolastica" => [

            ],
            "email_riferimento" => [

            ],
            "user_id" => [

            ],
            "id" => [

            ]
        ],
        'relations' => [
            "regione" => [
                "fields" => [

                ]
            ],
            "provincia" => [
                "fields" => [

                ]
            ],
            "user" => [
                "fields" => [

                ]
            ]
        ],
        'params' => [

        ],
    ],
    'edit' => [
        'fields' => [
            "anno" => [

            ],
            "area_geografica" => [
                'options' => 'method',
            ],
            "regione_id" => [

            ],
            "provincia_id" => [
                'options' => 'relation:provincia',
            ],
            "codice_istituto_riferimento" => [

            ],
            "denominazione_istituto_riferimento" => [

            ],
            "codice" => [

            ],
            "denominazione" => [

            ],
            "indirizzo" => [

            ],
            "cap" => [

            ],
            "catastale_comune" => [

            ],
            "comune" => [

            ],
            "caratteristica" => [

            ],
            "tipologia_grado_istruzione" => [

            ],
            "indicazione_sede_direttivo" => [

            ],
            "indicazione_sede_omnicomprensivo" => [

            ],
            "email" => [

            ],
            "pec" => [

            ],
            "web" => [

            ],
            "sede_scolastica" => [
                "options" => 'boolean',
                "nulloption" => false,

            ],
            "email_riferimento" => [

            ],
            "user_id" => [

            ],
            "id" => [

            ]
        ],
        'relations' => [
            "regione" => [
                "fields" => [

                ],
                "savetype" => [

                ]
            ],
            "provincia" => [
                "fields" => [

                ],
                "savetype" => [

                ]
            ],
            "user" => [
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
