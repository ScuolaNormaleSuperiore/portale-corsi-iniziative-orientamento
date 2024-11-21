<?php


/*
 * 'model' => <MODELNAME>
 * <FORMNAME> =>  [ //nome del form da route
 *      type => <FORMTYPE>, //tipo di form (opzionale se non c'è viene utilizzato il nome)
 *              //search, list, edit, insert, view, csv, pdf
 *      fields => [ //i campi del modello principale
 *          <FIELDNAME> => [
 *              'default' => <DEFAULTVALUE> //valore di default del campo (null se non presente)
 *              'options' => array|belongsto:<MODELNAME>|dboptions|boolean
 *                          //le opzioni possibili di un campo, prese da un array associativo,
 *                              da una relazione (gli id del modello correlato
 *                              dal database (enum ecc...)
 *                              booleano
 *              'nulloption' => true|false|onchoice //onchoice indica che l'opzione nullable è presente solo se i valori
 *                                  delle options sono più di uno; default: true,
 *              'null-label' => etichetta da associare al null
 *              'bool-false-value' => valore da associare al false
 *              'bool-false-label' => etichetta da associare al false
 *              'bool-true-value' => valore da associare al true
 *              'bool-true-label' => etichetta da associare al true
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

    'form-manager' => 'Gecche\\Cupparis\\App\\Foorm\\FoormManager',
    'submit_protocol' => 'form',

    'models_namespace' => "App\\Models\\",
    'foorms_namespace' => "App\\Foorm\\",
    'foorms_defaults_namespace' => "Gecche\\Cupparis\\App\\Foorm\\Base\\",

    'foorms' => [
        'user',
        'materia',
        'settore',
        'regione',
        'provincia',
        'scuola',
        'dscuola',
        'iniziativa',
        'corso',
        'filtro_selezione',
        'titolo_studio',
        'livello_linguistico',
        'professione',
        'modalita_conoscenza_sns',
        'candidato',
        'candidato_voti',
        'candidato_corso',
        'appuntamento',
        'pagina',
        'pagina_orientamento',
        'sezione_contenuto',
        'classe',
        'materia_orientamento',
        'studente_orientamento',
        'news',
        'evento',
        'sezione_layout',
        'categoria_video',
        'video',
        'scuola_richiesta',
//        'foto',
//        'attachment',
    ],

    'types_fallbacks' => [
        'insert' => 'edit',
    ],



    'bool-false-value' => 0,
    'bool-false-label' => 'No',
    'bool-true-value' => 1,
    'bool-true-label' => 'Sì',
    'null-value' => -1,
    'null-label' => 'Seleziona...',
    'any-label' => 'Qualsiasi',
    'no-value' => -2,
    'no-label' => 'Nessun valore',

    'relations_save_types' => [
        'belongs_to_many' => 'standard', //standard, add, standard_with_save:<PivotModelName>
        'has_many' => 'standard', //standard, add
        'belongs_to' => 'standard', //standard, add, morphed
    ],

    'expected_input_values' => [

    ],

    'actions' => [
      'delete' => [],
      'multi-delete' => [],
      'set' => [
          'allowed_fields' => [

          ],
      ],
      'autocomplete' => [
          'banned_fields' => [

          ],
          'provincia_id' => [
              'model' => 'cup_geo_provincia'
          ],
//          'fields' => [
//             'parent_id' => [
//                 'model' => 'Ciccio',  //MODELLO SU CUI FARE AUTOCOMPLETE
//                 'search_fields' => ['id','codice'], //CAMPI SU CUI EFFETTURAE LA RICERCA (IL DEFAULT E' NEL MDOELLO
//                                    CON LA PROPRIETA' $columnsSearchAutoComplete
//                 'result_fields' => ['codice','descrizione'] //CAMPI DI RITORNO DALLA RICERCA (IL DEFAULT E' NEL MDOELLO
////                                    CON LA PROPRIETA' $columnsForSelectList (I CAMPI CON RELAZIONI DEVONO ESSERE
///                                     NELLA FORMA relation|field
//                 'n_items' => 40, //NUM MAX DI RISULTATI IL DEFAULT E' NEL MODELLO
//////                                    CON LA PROPRIETA' $nItemsAutoComplete
//                 'autocomplete_type' => 'ciccio', //Metodo del MODELLO da chiamare IN questo esempio sarebbe
//                                              autocompleteCiccio invece di autocomplete
//             ]
//          ]
      ],
      'uploadfile' => [
          'allowed_fields' => [
              'fotos|resource',
              'attachments|resource',
          ],
          'fields' => [
              'fotos|resource' => [
                  'resource_type' => 'foto',
                  //'max_size' => '4M',
                  //'exts' => 'jpg,png',
              ],
              'attachments|resource' => [
                  'resource_type' => 'attachment',
                  //'max_size' => '10M',
              ],
          ],
      ],
    ],

    'types_defaults' => [
        'list' => [
            'pagination' => [
                'per_page' => 10,
                'no_paginate_value' => 1000000,
                'pagination_steps' => [10, 25, 50, 100],
            ],

            'allowed_actions' => [
                'delete' => true,
                'multi-delete' => true,
                'set' => true,
            ],
        ],
        'edit' => [
            'allowed_actions' => [
                'autocomplete' => true,
                'uploadfile' => true,
            ],
        ],
        'insert' => [
            'allowed_actions' => [
                'autocomplete' => true,
                'uploadfile' => true,
            ],
        ],
        'search' => [
            'allowed_actions' => [
                'autocomplete' => true,
            ],
        ],
        'view' => [
            'allowed_actions' => [

            ],
        ],
    ],

];
