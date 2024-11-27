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
                    'title' =>'Dati anagrafici'
                ],
                [
                    'code' => 'dati_contatto',
                    'title' =>'Dati di contatto'
                ],
                [
                    'code' => 'genitori',
                    'title' =>'Titoli e professioni dei genitori'
                ],
            ]
        ],
        2 => [
            'title' => 'Info scolastiche',
            'sections' => [

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

    public function create(Request $request, Iniziativa $iniziativa)
    {

        $step = 1;
        $candidaturaTitle = $iniziativa->titolo;

        $steps = $this->steps;


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
