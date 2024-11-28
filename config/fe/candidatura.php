<?php

return [
    'steps' => [
        1 => [
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
                        'comune' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                        'cap' => [
                            'validation' => [
                                'required',
                            ]
                        ],
                        'provincia_id' => [
                            'validation' => [
                                'required',
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
            'title' => 'Info scolastiche',
            'sections' => [
                [
                    'code' => 'scuola',
                    'title' => 'Scuola e classe',
                    'fields' => [
                        'scuola_id' => [
                            'validation' => [
                                'required',
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

                    ],
                ],
                [
                    'code' => 'allegati',
                    'title' => 'Allegati',
                    'subtitle' => ' In questa sezione, puoi caricare le pagelle scolastiche degli ultimi tre anni. Assicurati che i documenti siano chiari e completi, includendo tutti i voti finali per ciascun anno scolastico richiesto.',
                    'fields' => [
                        'curriculum' => [
                            'validation' => [],
                        ]
                    ],
                ],
            ]
        ],
        3 => [
            'title' => 'Profilo, competenze ed esperienze',
            'sections' => [

            ]
        ],
        4 => [
            'title' => 'Preferenze e Corsi',
            'sections' => [

            ]
        ],
        5 => [
            'title' => 'Informativa',
            'sections' => [

            ]
        ],
        6 => [
            'title' => 'Riepilogo',
            'sections' => [

            ]
        ],
    ],
];

