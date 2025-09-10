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

    'model' => 'candidato',
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
            "nazione_id" => [

            ],
            "comune_id" => [

            ],
            "comune_estero" => [

            ],
            "color" => [

            ],
        ],
        'appends' => [
            'color',
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
            "nazione" => [
                "fields" => [
                    "nome" => [],
                ]
            ],
            "regione" => [
                "fields" => [
                    "nome" => [],
                ]
            ],
            "comune" => [
                "fields" => [
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
        'model' => 'candidato',
        'fields' => [
            "nome" => [
                "operator" => "="
            ],
            "cognome" => [
                "operator" => "="
            ],
            "codice_fiscale" => [
                "operator" => "="
            ],
            "data_nascita" => [
                "operator" => "=",
            ],
        ],
    ],
    'list' => [
        'model' => 'candidato',
        'actions' => [
        ],
        'allowed_actions' => [
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
            "color" => [

            ],
            "scuola_estera" => [

            ],
        ],
        'appends' => [
            'color',
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
                    "codice" => [],
                    "denominazione" => [],
                    "comune" => [],
                    "provincia_sigla" => [],
                ]
            ],
            "user" => [
                "fields" => [

                ]
            ],
            "comune" => [
                "fields" => [

                ]
            ],
            "nazione" => [
                "fields" => [

                ]
            ],
            "provincia" => [
                "fields" => [
                    'sigla' => [],
                ]
            ],
            "regione" => [
                "fields" => [
                    'nome' => [],
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
//    'insert' => [
//
//    ],

];
