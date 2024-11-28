<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\Classe;
use App\Models\Evento;
use App\Models\Iniziativa;
use App\Models\News;
use App\Models\Pagina;
use App\Models\PaginaOrientamento;
use App\Models\SezioneLayout;
use App\Models\StudenteOrientamento;
use App\Models\Video;
use Gecche\Foorm\Facades\Foorm;
use Igaster\LaravelTheme\Facades\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CandidatureController extends Controller
{

    protected $steps = [
        1 => [
            'title' => 'Dati personali e familiari',
            'sections' => [
                [
                    'code' => 'dati_anagrafici',
                    'title' =>'Dati anagrafici',
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
                    'title' =>'Dati di contatto',
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
                    'title' =>'Titoli e professioni dei genitori',
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
                    'title' =>'Scuola e classe',
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
                    'title' =>'Voti scolastici',
                    'fields' => [

                    ],
                ],
                [
                    'code' => 'allegati',
                    'title' =>'Allegati',
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
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Theme::set('sns');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $iniziative = Iniziativa::with('authcandidature')
            ->where('attivo', 1)
            ->whereDate('data_apertura', '<=', date('Y-m-d'))
            ->whereDate('data_chiusura', '>=', date('Y-m-d'))
            ->orderBy('data_apertura', 'ASC')
            ->get();


        $user = Auth::user();
        $nomeCognome = $user->fename;

        $maxCandidatureScuole = config('sns.max_candidature_scuole', 5);


        return view('candidature.index', compact('iniziative', 'nomeCognome', 'maxCandidatureScuole'));
    }

    protected function setOptionsInStepData($stepData,$metadata) {
        foreach ($stepData['sections'] as $section => $sectionData) {

            foreach (Arr::get($sectionData,'fields',[]) as $fieldName => $fieldData) {

                $options = Arr::get($metadata['fields'][$fieldName],'options');
                if (is_array($options)) {
                    $stepData['sections'][$section]['fields'][$fieldName]['options'] = [];
                    foreach($options as $optionValue => $optionLabel) {
                        $stepData['sections'][$section]['fields'][$fieldName]['options'][] = [
                            'value' => $optionValue,
                            'label' => $optionLabel,
                        ];
                    }

                }

            }

        }

        return $stepData;

    }

    public function create(Request $request, Iniziativa $iniziativa)
    {
        $step = 1;
        $candidaturaTitle = $iniziativa->titolo;
        $steps = $this->steps;

        $foorm = Foorm::getFoorm('candidato.insert',$request,[]);
        $metadata = $foorm->getFormMetadata();

        $steps[$step] = $this->setOptionsInStepData($steps[$step],$metadata);
        return view('candidature.create', compact('iniziativa','candidaturaTitle', 'steps','step'));
    }

    public function store(Request $request, Iniziativa $iniziativa)
    {
        $step = 1;
        $candidaturaTitle = $iniziativa->titolo;
        $steps = $this->steps;

        $foorm = Foorm::getFoorm('candidato.insert',$request,[]);
        $metadata = $foorm->getFormMetadata();

        $steps[$step] = $this->setOptionsInStepData($steps[$step],$metadata);
        return view('candidature.create', compact('iniziativa','candidaturaTitle', 'steps','step'));
    }

    public function edit(Request $request, Candidato $candidatura, $step = 1)
    {

        $iniziativa = $candidatura->iniziativa;

        $candidaturaTitle = $iniziativa->titolo;

        $steps = $this->steps;
        return view('candidature.edit', compact('candidaturaTitle', 'steps','step'));
    }

    public function update(Request $request, Candidato $candidatura, $step = 1)
    {

        $iniziativa = $candidatura->iniziativa;

        $candidaturaTitle = $iniziativa->titolo;

        $steps = $this->steps;
        return view('candidature.edit', compact('candidaturaTitle', 'steps','step'));
    }

}
