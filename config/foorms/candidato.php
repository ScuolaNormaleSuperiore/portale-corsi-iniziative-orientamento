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
            "nome" => [

            ],
            "cognome" => [

            ],
            "emails" => [

            ],
            "sesso" => [

            ],
            "luogo_nascita" => [

            ],
            "data_nascita" => [

            ],
            "indirizzo" => [

            ],
            "comune" => [

            ],
            "cap" => [

            ],
            "provincia_id" => [

            ],
            "telefono" => [

            ],
            "scuola_id" => [

            ],
            "classe" => [

            ],
            "sezione" => [

            ],
            "gen1_titolo_studio_id" => [

            ],
            "gen2_titolo_studio_id" => [

            ],
            "gen1_professione_id" => [

            ],
            "gen2_professione_id" => [

            ],
            "gen1_professione_altro" => [

            ],
            "gen2_professione_altro" => [

            ],
            "note" => [

            ],
            "partecipazione_concorsi" => [

            ],
            "inglese_livello_linguistico_id" => [

            ],
            "francese_livello_linguistico_id" => [

            ],
            "tedesco_livello_linguistico_id" => [

            ],
            "spagnolo_livello_linguistico_id" => [

            ],
            "cinese_livello_linguistico_id" => [

            ],
            "altre_competenze_linguistiche" => [

            ],
            "esperienze_estere" => [

            ],
            "settore_professionale" => [

            ],
            "motivazioni" => [

            ],
            "modalita_conoscenza_sns_id" => [

            ],
            "informativa" => [

            ],
            "media" => [

            ],
            "tipo" => [

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
            "nome" => [
                "operator" => "like"
            ],
            "cognome" => [
                "operator" => "like"
            ],
            "codice_fiscale" => [
                "operator" => "like"
            ],
            "iniziativa_id" => [
                "operator" => "=",
                "options" => "relation:iniziativa"
            ],
            "provincia_id" => [
                "operator" => "=",
                "options" => "relation:provincia"
            ],
            "scuola_id" => [
                "operator" => "=",
                "options" => "relation:scuola"
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
            'id' => [

            ],
            "nome" => [

            ],
            "cognome" => [

            ],
            "data_candidatura" => [

            ],
            "status" => [

            ],
        ],
        'relations' => [
            "iniziativa" => [
                "fields" => [
                    "titolo" => [],
                ]
            ],
            "scuola" => [
                "fields" => [
                    "denominazione" => [],
                    "comune" => [],
                    "provincia_sigla" => [],
                ]
            ],
            "user" => [
                "fields" => [

                ]
            ],
        ],
        'params' => [

        ],
    ],
    'edit' => [
        'actions' => [
            'uploadfile' => [
                'allowed_fields' => [
                    'attachments|resource',
                ],
                'fields' => [
                    'attachments|resource' => [
                        'resource_type' => 'attachment',
                        //'max_size' => '4M',
                        'exts' => 'pdf',
                    ],
//                'thumb_url_file' => [
//                    'resource_type' => 'foto',
//                    //'max_size' => '4M',
//                    'exts' => 'png,jpg',
//                ],
                ],
            ],
            'autocomplete' => [
                'fields' => [
                    'scuola_id' => [
                        'model' => 'Scuola',
                        'result_fields' => [
                            'id',
                            'denominazione',
                            'denominazione_istituto_riferimento',
                            'codice',
                            'comune',
                            'provincia|sigla'
                        ]
                    ],
                ]
            ],
        ],
        'fields' => [
            'id' => [

            ],
            'iniziativa_id' => [
                'options' => 'relation:iniziativa',
            ],
            "anno" => [

            ],
            "nome" => [

            ],
            "cognome" => [

            ],
            "codice_fiscale" => [

            ],
            "emails" => [

            ],
            "sesso" => [
                'options' => config('enums.sesso'),
            ],
            "luogo_nascita" => [

            ],
            "data_nascita" => [

            ],
            "indirizzo" => [

            ],
            "comune" => [

            ],
            "cap" => [

            ],
            "provincia_id" => [
                'options' => 'relation:provincia',
            ],
            "telefono" => [

            ],
            "scuola_id" => [
                'referred_data' => 'method:model',
            ],
            "scuola_estera" => [

            ],
            "classe" => [
                'options' => [
                    3 => '3^',
                    4 => '4^',
                    5 => '5^',
                ]
            ],
            "sezione" => [

            ],
            "profilo" => [

            ],
            "gen1_titolo_studio_id" => [
                'options' => 'model:TitoloStudio',
            ],
            "gen2_titolo_studio_id" => [
                'options' => 'model:TitoloStudio',
            ],
            "gen1_professione_id" => [
                'options' => 'model:Professione',
            ],
            "gen2_professione_id" => [
                'options' => 'model:Professione',
            ],
            "gen1_professione_altro" => [

            ],
            "gen2_professione_altro" => [

            ],
            "note" => [

            ],
            "partecipazione_concorsi" => [

            ],
            "inglese_livello_linguistico_id" => [
                'options' => 'model:LivelloLinguistico',
            ],
            "francese_livello_linguistico_id" => [
                'options' => 'model:LivelloLinguistico',
            ],
            "tedesco_livello_linguistico_id" => [
                'options' => 'model:LivelloLinguistico',
            ],
            "spagnolo_livello_linguistico_id" => [
                'options' => 'model:LivelloLinguistico',
            ],
            "cinese_livello_linguistico_id" => [
                'options' => 'model:LivelloLinguistico',
            ],
            "altre_competenze_linguistiche" => [

            ],
            "esperienze_estere" => [

            ],
            "materie_preferite" => [

            ],
            "settore_professionale" => [

            ],
            "motivazioni" => [

            ],
            "modalita_conoscenza_sns_id" => [
                'options' => 'model:ModalitaConoscenzaSns',
            ],
            "informativa" => [

            ],
            "media" => [

            ],
            "tipo" => [

            ],
            "user_id" => [

            ],
            "status" => [

            ],
            "conferma" => [

            ],
            "pagamento" => [

            ],

        ],
        'relations' => [
            "attachments" => [
                "fields" => [
                    'id' => [],
                    'nome' => [],
                    'descrizione' => [],
                    'resource' => [],
                    'ordine' => [],
                    'dim' => [],
                ],
                'orderKey' => 'ordine',

                'beforeNewCallbackMethods' => ['setFieldsFromResource'],
                'beforeUpdateCallbackMethods' => ['setFieldsFromResource'],
                'afterNewCallbackMethods' => ['filesOps'],
                'afterUpdateCallbackMethods' => ['filesOps'],
            ],
            'corsi' => [
                'as_options' => [
                    'nulloption' => false,
                ],
            ],
            'voti' => [
                'fields' => [
                    'id' => [],
                    'voto_anno_1' => [],
                    'voto_anno_2' => [],
                    'voto_primo_quadrimestre' => [],
                    'materia_id' => [
                        'options' => 'model:Materia',
                    ]
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
