<?php

return [
    'steps' => [
        1 => [
            'riepilogo' => true,
            'code' => 'dati_personali',
            'title' => 'Dati personali e familiari',
            'sections' => [
                [
                    'code' => 'dati_anagrafici',
                    'title' => 'Dati anagrafici',
                    'fields' => [
                        'cognome' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                        'nome' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                        'codice_fiscale' => [
                            'validation' => [
                                'required',
                            ]
                        ],

                        'luogo_nascita' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                        'data_nascita' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                        'sesso' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                    ],
                ],
                [
                    'code' => 'dati_contatto',
                    'title' => 'Dati di contatto',
                    'fields' => [
                        'emails' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                        'telefono' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                        'indirizzo' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                        'comune_estero' => [
                            'validation' => [
//                                'required',
                            ]
                        ],
                        'cap' => [
                            'validation' => [
                                'required',
                                'numeric',
                                'max_digits:5',
                            ]
                        ],
                        'nazione_id' => [
                            'validation' => [
//                                'required',
                            ]
                        ],
                        'provincia_id' => [
                            'validation' => [
//                                'required',
                            ]
                        ],
                        'comune_id' => [
                            'validation' => [
//                                'required',
                            ]
                        ],

                    ],
                ],
                [
                    'code' => 'genitori',
                    'title' => 'Titoli e professioni dei genitori',
                    'fields' => [
                        'gen1_titolo_studio_id' => [],
                        'gen2_titolo_studio_id' => [],
                        'gen1_professione_id' => [],
                        'gen2_professione_id' => [],
                        'gen1_professione_altro' => [],
                        'gen2_professione_altro' => [],

                    ],
                ],
            ]
        ],
        2 => [
            'riepilogo' => true,
            'code' => 'info_scolastiche',
            'title' => 'Info scolastiche',
            'sections' => [
                [
                    'code' => 'scuola',
                    'title' => 'Scuola e classe',
                    'fields' => [
                        'provincia_scuola_id' => [
                            'validation' => [
                            ]
                        ],
                        'scuola_id' => [
                            'validation' => [
                                'nullable',
                                'exists:scuole,id',
                            ]
                        ],
                        'scuola_estera' => [
                            'validation' => [
                                'required_without:scuola_id',
                            ]
                        ],
                        'classe' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                        'sezione' => [
                            'validation' => [
                                'required',
                            ]
                        ],

                    ],
                ],
                [
                    'code' => 'voti',
                    'title' => 'Voti scolastici',
                    'fields' => [
                        'voti' => [

                        ],
                    ],
                ],
                [
                    'code' => 'allegati',
                    'title' => 'Allegati',
                    'subtitle' => ' In questa sezione, puoi caricare le pagelle scolastiche degli ultimi tre anni. Assicurati che i documenti siano chiari e completi, includendo tutti i voti finali per ciascun anno scolastico richiesto.',
                    'fields' => [
                        'attachments' => [
                            'validation' => [

                            ],
                            'exts' => 'pdf,png,jpg',
                        ]
                    ],
                ],
            ]
        ],
        3 => [
            'riepilogo' => true,
            'code' => 'profilo_competenze',
            'title' => 'Profilo, competenze ed esperienze',
            'sections' => [
                [
                    'code' => 'profilo',
                    'title' => 'Profilo personale',
                    'fields' => [
                        'profilo' => [
                            'validation' => [
                                'required',
                                'max:' . env('MAX_LENGTH_TEXTAREA', 1500),
                                'min:' . env('MIN_LENGTH_TEXTAREA', 400)
                            ],
                            'maxLength' => env('MAX_LENGTH_TEXTAREA', 1500),
                            'minLength' => env('MIN_LENGTH_TEXTAREA', 400),
                        ]

                    ]
                ],
                [
                    'code' => 'competenze_linguistiche',
                    'title' => 'Competenze linguistiche',
                    'fields' => [
                        'inglese_livello_linguistico_id' => [
                            'validation' => [
//                                'required'
                            ],
                        ],
                        'francese_livello_linguistico_id' => [
                            'validation' => [
//                                'required'
                            ],
                        ],
                        'spagnolo_livello_linguistico_id' => [
                            'validation' => [
//                                'required'
                            ],
                        ],
                        'tedesco_livello_linguistico_id' => [
                            'validation' => [
//                                'required'
                            ],
                        ],
                        'cinese_livello_linguistico_id' => [
                            'validation' => [
//                                'required'
                            ],
                        ],
                        'altre_competenze_linguistiche' => [
                            'validation' => [
//                                'required'
                            ],
                        ],

                    ]
                ],
                [
                    'code' => 'partecipazione_concorsi',
                    'title' => 'Partecipazione a concorsi e risultati',
                    'fields' => [
                        'olimpiadi_matematica' => [
                            'validation' => [
                                'required'
                            ],
                        ],
                        'olimpiadi_matematica_squadre' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                        'olimpiadi_matematica_squadre_femminili' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                        'olimpiadi_fisica' => [
                            'validation' => [
                                'required'
                            ],
                        ],
                        'olimpiadi_fisica_squadre_miste' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                        'olimpiadi_scienze_naturali' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                        'giochi_chimica' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                        'olimpiadi_informatica' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                        'stages' => [
                            'validation' => [
//                                'required',
                            ]
                        ],
                        'gare_internazionali' => [
                            'validation' => [
//                                'required',
                            ]
                        ],
                        'gare_umanistiche' => [
                            'validation' => [
//                                'required',
                            ]
                        ],
                        'partecipazione_concorsi' => [
                            'validation' => [
                                'max:' . env('MAX_LENGTH_TEXTAREA', 1500),
//                                'min:' . env('MIN_LENGTH_TEXTAREA', 400)
                            ],
                            'maxLength' => env('MAX_LENGTH_TEXTAREA', 1500),
//                            'minLength' => env('MIN_LENGTH_TEXTAREA', 400),
                        ],

                    ]
                ],
                [
                    'code' => 'esperienze_estere',
                    'title' => 'Eventuali esperienze all\'estero',
                    'fields' => [
                        'esperienze_estere' => [
                            'validation' => [
                                'max:' . env('MAX_LENGTH_TEXTAREA', 1500),
//                                'min:' . env('MIN_LENGTH_TEXTAREA', 400)
                            ],
                            'maxLength' => env('MAX_LENGTH_TEXTAREA', 1500),
//                            'minLength' => env('MIN_LENGTH_TEXTAREA', 400),
                        ]

                    ]
                ],
            ]
        ],
        4 => [
            'riepilogo' => true,
            'code' => 'preferenze',
            'title' => 'Preferenze e Corsi',
            'sections' => [
                [
                    'code' => 'materie_settori',
                    'title' => 'Materie e settori preferiti',
                    'fields' => [
                        'materie_preferite' => [

                        ],
                        'settore_professionale' => [

                        ]
                    ]
                ],
                [
                    'code' => 'motivazioni',
                    'title' => 'Motivazioni',
                    'subtitle' => 'Motivazioni che spingono a partecipare ai corsi della SNS',
                    'fields' => [
                        'motivazioni' => [
                            'validation' => [
                                'required',
                                'max:' . env('MAX_LENGTH_TEXTAREA', 1500),
                                'min:' . env('MIN_LENGTH_TEXTAREA', 400)
                            ],
                            'maxLength' => env('MAX_LENGTH_TEXTAREA', 1500),
                            'minLength' => env('MIN_LENGTH_TEXTAREA', 400),
                        ]

                    ]
                ],
                [
                    'code' => 'corsi',
                    'title' => 'Preferenze per i corsi',
                    'subtitle' => 'Seleziona uno o più corsi presenti nell\'elenco',
                    'fields' => [
                        'corsi' => [
                            'validation' => [
                                'required',
//                                'max:500'
                            ],
                        ]

                    ]
                ],
                [
                    'code' => 'conoscenza_sns',
                    'title' => 'Come ha scoperto i corsi SNS?',
                    'fields' => [
                        'modalita_conoscenza_sns_id' => [
                            'validation' => [
                                'required',
                            ],
                        ]

                    ]
                ],
            ]
        ],
        5 => [
            'title' => 'Informativa',
            'sections' => [
                [
                    'code' => 'informativa',
                    'title' => 'Informativa',
                    'fields' => [
                        'informativa' => [
                            'validation' => [
                                'accepted',
                            ]
                        ],
                    ]
                ]
            ]
        ],
        6 => [
            'title' => 'Riepilogo',
            'sections' => [

            ]
        ],
    ],
];

