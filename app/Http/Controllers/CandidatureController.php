<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\Classe;
use App\Models\Evento;
use App\Models\Iniziativa;
use App\Models\News;
use App\Models\Pagina;
use App\Models\PaginaOrientamento;
use App\Models\Scuola;
use App\Models\SezioneLayout;
use App\Models\StudenteOrientamento;
use App\Models\Video;
use Gecche\Foorm\Facades\Foorm;
use Igaster\LaravelTheme\Facades\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Validation\ValidationException;

class CandidatureController extends Controller
{

    protected $steps = [];
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Theme::set('sns');
        $this->steps = Config::get('fe.candidatura.steps',[]);
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

    protected function setOptionsInStepData($stepData, $metadata)
    {

        foreach ($stepData['sections'] as $section => $sectionData) {

            foreach (Arr::get($sectionData, 'fields', []) as $fieldName => $fieldData) {

                if ($fieldName == 'voti') {
//                    Log::info("VOTI::::");
//                    Log::info($metadata['relations']);
                    $options = Arr::get(Arr::get(Arr::get(Arr::get($metadata['relations'], 'voti', []), 'fields', []), 'materia_id', []), 'options', []);
                } elseif ($fieldName == 'corsi') {
                    $options = Arr::get(Arr::get($metadata['relations'], 'corsi', []), 'options', []);
                } else {
                    $options = Arr::get(Arr::get($metadata['fields'],$fieldName,[]), 'options', []);
                }
                if (is_array($options)) {
                    $stepData['sections'][$section]['fields'][$fieldName]['options'] = [];
                    foreach ($options as $optionValue => $optionLabel) {
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

    protected function setValuesInStepData($stepData, $data)
    {
        foreach ($stepData['sections'] as $section => $sectionData) {

            foreach (Arr::get($sectionData, 'fields', []) as $fieldName => $fieldData) {

                $value = Arr::get($data, $fieldName);
                $stepData['sections'][$section]['fields'][$fieldName]['value'] =
                    $value;

                Log::info($data);

                if ($fieldName == 'scuola_id' && $value) {
                    $scuola = Scuola::find($value);
                    if ($scuola) {
                        $stepData['sections'][$section]['fields'][$fieldName]['referred_data']
                          = $scuola->getScuolaFE();

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

        $foorm = Foorm::getFoorm('candidato.insert', $request, []);
        $metadata = $foorm->getFormMetadata();

        $req = $request->all();

        $steps[$step] = $this->setOptionsInStepData($steps[$step], $metadata);
        return view('candidature.create', compact('iniziativa', 'candidaturaTitle', 'steps', 'step', 'req'));
    }

    public function store(Request $request, Iniziativa $iniziativa)
    {
        $step = 1;
        $candidaturaTitle = $iniziativa->titolo;
        $steps = $this->steps;
        $req = $request->all();


        $request->request->add(['iniziativa_id' => $iniziativa->getKey()]);


        $foorm = Foorm::getFoorm('candidato.insert', $request, []);

        $foorm->save();

        $candidatura = $foorm->getModel();
        $metadata = $foorm->getFormMetadata();


        $submitType = $request->get('submit-type', 'save');
        if ($submitType) {
            $data = $foorm->getFormData();
            $steps[$step] = $this->setValuesInStepData($steps[$step], $data);
            if ($submitType == 'next') {
                $step++;
            }
        }
        $steps[$step] = $this->setOptionsInStepData($steps[$step], $metadata);
        return view('candidature.edit', compact('candidatura', 'iniziativa', 'candidaturaTitle', 'steps', 'step', 'req'));
    }

    public function edit(Request $request, Candidato $candidatura, $step = 1)
    {

        $iniziativa = $candidatura->iniziativa;
        $candidaturaTitle = $iniziativa->titolo;
        $steps = $this->steps;
        $req = $request->all();

        $foorm = Foorm::getFoorm('candidato.edit', $request, ['id' => $candidatura->getKey()]);

        $metadata = $foorm->getFormMetadata();
        $data = $foorm->getFormData();

        $steps[$step] = $this->setOptionsInStepData($steps[$step], $metadata);
        $steps[$step] = $this->setValuesInStepData($steps[$step], $data);

        return view('candidature.edit', compact('candidatura', 'iniziativa', 'candidaturaTitle', 'steps', 'step', 'req'));
    }

    public function update(Request $request, Candidato $candidatura)
    {

        $step = $request->get('step');
        $iniziativa = $candidatura->iniziativa;
        $candidaturaTitle = $iniziativa->titolo;
        $steps = $this->steps;
        $req = $request->all();

        $foorm = Foorm::getFoorm('candidato.edit', $request, ['id' => $candidatura->getKey()]);

        $errors = new MessageBag();
        try {
            $foorm->save();
        } catch (ValidationException $e) {
            return redirect(route('candidatura.edit',[
                'candidatura' => $candidatura->getKey(),
                'step' => $step,
            ]))->withErrors($e->errors());
        }

        $metadata = $foorm->getFormMetadata();
        $data = $foorm->getFormData();

        $submitType = $request->get('submit-type', 'save');
        if ($submitType == 'next') {
            $step++;
        }
        $steps[$step] = $this->setOptionsInStepData($steps[$step], $metadata);
        $steps[$step] = $this->setValuesInStepData($steps[$step], $data);
        return view('candidature.edit', compact('candidatura', 'iniziativa', 'candidaturaTitle', 'steps', 'step', 'req','errors'));

    }

}
