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

use App\Models\LivelloLinguistico;

return [

    'view' => [
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
            "olimpiadi_matematica" => [
                'options' => 'enum:App\\Enums\\OlimpiadiMatematica',
                'nulloption' => false,
                'default' => 'nessuna_partecipazione',
            ],
            "olimpiadi_fisica" => [
                'options' => 'enum:App\\Enums\\OlimpiadiFisica',
                'nulloption' => false,
                'default' => 'nessuna_partecipazione',
            ],

            'olimpiadi_matematica_squadre' => [
                'options' => 'enum:App\\Enums\\OlimpiadiMatematicaSquadre',
                'nulloption' => false,
                'default' => 'nessuna_partecipazione',
            ],
            'olimpiadi_matematica_squadre_femminili' => [
                'options' => 'enum:App\\Enums\\OlimpiadiMatematicaSquadreFemminili',
                'nulloption' => false,
                'default' => 'nessuna_partecipazione',
            ],
            'olimpiadi_fisica_squadre_miste' => [
                'options' => 'enum:App\\Enums\\OlimpiadiFisicaSquadreMiste',
                'nulloption' => false,
                'default' => 'nessuna_partecipazione',
            ],
            'olimpiadi_scienze_naturali' => [
                'options' => 'enum:App\\Enums\\OlimpiadiScienzeNaturali',
                'nulloption' => false,
                'default' => 'nessuna_partecipazione',
            ],
            'giochi_chimica' => [
                'options' => 'enum:App\\Enums\\GiochiChimica',
                'nulloption' => false,
                'default' => 'nessuna_partecipazione',
            ],
            'olimpiadi_informatica' => [
                'options' => 'enum:App\\Enums\\OlimpiadiInformatica',
                'nulloption' => false,
                'default' => 'nessuna_partecipazione',
            ],
            'stages' => [
                'options' => 'enum:App\\Enums\\Stages',
                'nulloption' => false,
            ],
            'gare_internazionali' => [
                'options' => 'enum:App\\Enums\\GareInternazionali',
                'nulloption' => false,
            ],
            'gare_umanistiche' => [
                'options' => 'enum:App\\Enums\\GareUmanistiche',
                'nulloption' => false,
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
                'options' => 'boolean',
            ],
            "media" => [

            ],
            "tipo" => [

            ],
            "user_id" => [

            ],
            "status" => [
                "options" => 'enum:App\\Enums\\CandidatoStatuses',
            ],
            "conferma" => [

            ],
            "pagamento" => [

            ],
            "data_candidatura" => [

            ],
        ],
        "relations" => [

            "attachments" => [
                "fields" => [
                    "id" => [],
                ]
            ],
            "iniziativa" => [
                "fields" => [
                    "titolo" => [],
                ]
            ],
            "provincia" => [
                "fields" => [
                    "sigla" => [],
                    "nome" => [],
                ]
            ],
            "scuola" => [
                "fields" => [
                    "denominazione" => [],
                    "codice" => [],
                    "tipologia_grado_istruzione" => [],
                    "comune" => [],
                    "provincia_id" => [],
                ]
            ],
            "voti" => [
                "fields" => [
                    'id' => [],
                    'voto_anno_1' => [],
                    'voto_anno_2' => [],
                    'voto_primo_quadrimestre' => [],
                    'materia_id' => [
                        'options' => 'model:Materia',
                    ]
                ]
            ],
            'corsi' => [
                'as_options' => [
//                    'field' => '',
                    'options' => 'method:createOptionsCorsi',
                    'nulloption' => false,
                ],
            ],
        ]
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
            "tipo" => [
                "operator" => "=",
                "options" => "enum:App\\Enums\\TipoCandidatura"
            ],
            "id" => [

            ],
            "status" => [
                "options" => 'enum:App\\Enums\\CandidatoStatuses',
            ]
        ],
    ],
    'list' => [
        'actions' => [
            'set' => [
                'allowed_fields' => [
                    'status',
                ],
            ],
            'xls-export' => [
                'default' => [
                    'blacklist' => [
//                        'password'
                    ],
                    'whitelist' => [
                        "cognome",
                        "nome",
                        "sesso",
                        "luogo_nascita",
                        "data_nascita",
                        "indirizzo",
                        "cap",
                        "comune",
                        "provincia_id",
                        "regione_id",
                        "telefono",
                        "emails",

                        "gen1_titolo_studio_id",
                        "gen2_titolo_studio_id",

                        "scuola|tipologia_grado_istruzione",
                        "classe",
                        "scuola|regione_id",

                        "scuola|biennio",
                        "scuola|denominazione",
                        "scuola|email_riferimento",
                        "profilo",


                        'olimpiadi_matematica',
                        'olimpiadi_matematica_squadre',
                        'olimpiadi_matematica_squadre_femminili',
                        'olimpiadi_fisica',
                        'olimpiadi_fisica_squadre_miste',
                        'olimpiadi_scienze_naturali',
                        'giochi_chimica',
                        'olimpiadi_informatica',

                        'stages',
                        'gare_internazionali',
                        'gare_umanistiche',
                        'partecipazione_concorsi',

                        'inglese_livello_linguistico_id',
                        'francese_livello_linguistico_id',
                        'spagnolo_livello_linguistico_id',
                        'tedesco_livello_linguistico_id',
                        'cinese_livello_linguistico_id',

                        'altre_competenze_linguistiche',

                        'esperienze_estere',
                        'materie_preferite',
                        'settore_professionale',
                        'motivazioni',

                        'corsi',

                        'media',
                        'status',
                        'voti',


                    ],
                    'fieldsParams' => [
                    ],
                    'separator' => ';',
                    'endline' => "\n",
                    'headers' => 'plain',
                    'decimalFrom' => '.',
                    'decimalTo' => false,
                ],
            ]
        ],
        'allowed_actions' => [
            'media-download' => true,
            "set" => true,
            "csv-export" => true,
            "xls-export" => true,
        ],
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
                "options" => 'enum:App\\Enums\\CandidatoStatuses',
            ],
            "tipo_text" => [

            ],
            "media" => [

            ],

        ],
        'appends' => [
            'tipo_text',
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
            "provincia" => [
                "fields" => [

                ]
            ],
            "corsi" => [
                "fields" => [

                ],
            ],
            "voti" => [
                "fields" => [

                ],
            ],
            "attachments" => [
                "fields" => [
                    'id' => [],
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
                    'attachments|resource',
                ],
                'fields' => [
                    'attachments|resource' => [
                        'resource_type' => 'attachment',
                        //'max_size' => '4M',
                        'exts' => 'pdf,png,jpg',
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
            "olimpiadi_matematica" => [
                'options' => 'enum:App\\Enums\\OlimpiadiMatematica',
                'nulloption' => false,
                'default' => 'nessuna_partecipazione',
            ],
            "olimpiadi_fisica" => [
                'options' => 'enum:App\\Enums\\OlimpiadiFisica',
                'nulloption' => false,
                'default' => 'nessuna_partecipazione',
            ],

            'olimpiadi_matematica_squadre' => [
                'options' => 'enum:App\\Enums\\OlimpiadiMatematicaSquadre',
                'nulloption' => false,
                'default' => 'nessuna_partecipazione',
            ],
            'olimpiadi_matematica_squadre_femminili' => [
                'options' => 'enum:App\\Enums\\OlimpiadiMatematicaSquadreFemminili',
                'nulloption' => false,
                'default' => 'nessuna_partecipazione',
            ],
            'olimpiadi_fisica_squadre_miste' => [
                'options' => 'enum:App\\Enums\\OlimpiadiFisicaSquadreMiste',
                'nulloption' => false,
                'default' => 'nessuna_partecipazione',
            ],
            'olimpiadi_scienze_naturali' => [
                'options' => 'enum:App\\Enums\\OlimpiadiScienzeNaturali',
                'nulloption' => false,
                'default' => 'nessuna_partecipazione',
            ],
            'giochi_chimica' => [
                'options' => 'enum:App\\Enums\\GiochiChimica',
                'nulloption' => false,
                'default' => 'nessuna_partecipazione',
            ],
            'olimpiadi_informatica' => [
                'options' => 'enum:App\\Enums\\OlimpiadiInformatica',
                'nulloption' => false,
                'default' => 'nessuna_partecipazione',
            ],
            'stages' => [
                'options' => 'enum:App\\Enums\\Stages',
                'nulloption' => false,
            ],
            'gare_internazionali' => [
                'options' => 'enum:App\\Enums\\GareInternazionali',
                'nulloption' => false,
            ],
            'gare_umanistiche' => [
                'options' => 'enum:App\\Enums\\GareUmanistiche',
                'nulloption' => false,
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
                'options' => 'boolean',
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
//                    'field' => '',
                    'options' => 'method:createOptionsCorsi',
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
            ],


        ],
        'params' => [

        ],
    ],
//    'insert' => [
//
//    ],

];
