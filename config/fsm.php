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

    'models' => [
        \App\Models\Candidato::class => 'candidato',
    ],

    'listener' => "\\App\\Listeners\\HandleStatusTransition",

    'models_listeners' => [
        \App\Models\Candidato::class => \App\Listeners\HandleCandidatoStatusTransition::class,
    ],

    'types' => [
        'candidato' => [

            'fsm' => null,//optional classname of the FSM, must implement Gecche\FSM\Contracts\FSMInterface
            // default Gecche\FSM\FSM
            'fsmConfigClass' => \App\Enums\CandidatoStatuses::class,

        ]
    ],

];
