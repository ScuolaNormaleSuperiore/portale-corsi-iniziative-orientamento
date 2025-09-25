<?php

namespace App\Http\Controllers;

use App\Enums\CandidatoStatuses;
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
use App\Policies\CandidatoPolicy;
use Gecche\Foorm\Facades\Foorm;
use Gecche\Foorm\FoormAction;
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

    protected $role;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Theme::set('sns');
        $this->steps = Config::get('fe.candidatura.steps', []);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $deleteId = $request->get('candidatura-delete');

        $errors = [];
        $success = null;


        if ($deleteId) {
            $candidatura = Candidato::find($deleteId);
            if ($candidatura && $candidatura->getKey() && $this->checkUserEdit($request,$candidatura)) {
                try {
                    $candidatura->delete();
                    $success = "Candidatura eliminata con successo";
                } catch (\Throwable $e) {
                    Log::info("Cancellazione candidatura ERROR");
                    Log::info($e->getMessage());
                    Log::info($e->getTraceAsString());
                    $errors[] = "Problemi nella cancellazione della candidatura";
                }
            } else {
                $errors[] = "Problemi nella cancellazione della candidatura";
            }
        }

        $iniziative = Iniziativa::where('attivo', 1)
            ->whereDate('data_apertura', '<=', date('Y-m-d'))
            ->whereDate('data_chiusura', '>=', date('Y-m-d'))
            ->orderBy('data_apertura', 'ASC')
            ->get();




        $user = Auth::user();

        $nomeCognome = $user->fename;

        //$maxCandidatureScuole = config('sns.max_candidature_scuole', 5);


        return view('candidature.index', compact('iniziative', 'nomeCognome', 'errors', 'success','user'));
    }

    protected function setOptionsInStepData($stepData, $metadata)
    {

        foreach ($stepData['sections'] as $section => $sectionData) {

            foreach (Arr::get($sectionData, 'fields', []) as $fieldName => $fieldData) {

                if ($fieldName == 'voti') {
//                    Log::info("VOTI::::");
//                    Log::info($metadata['relations']);
                    $options = Arr::get(Arr::get(Arr::get(Arr::get($metadata['relations'], 'voti', []), 'fields', []), 'materia_id', []), 'options', []);
                    //Aggiungo anche le opzioni dei voti

                    $votiOptions = Config::get('fe.candidatura.voti',[]);
                    $stepData['sections'][$section]['fields'][$fieldName]['voti_options'] = [];
                    foreach ($votiOptions as $optionValue => $optionLabel) {
                        $stepData['sections'][$section]['fields'][$fieldName]['voti_options'][] = [
                            'value' => $optionValue,
                            'label' => $optionLabel,
                        ];
                    }

                } elseif ($fieldName == 'corsi') {
                    $options = Arr::get(Arr::get($metadata['relations'], 'corsi', []), 'options', []);
                } else {
                    $options = Arr::get(Arr::get($metadata['fields'], $fieldName, []), 'options', []);
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


                if ($fieldName == 'scuola_id') {
                    $scuola = null;
                    if ($value && $value > 0) {
                        $scuola = Scuola::find($value);
                    } elseif ($this->role == 'Scuola') {
                        $scuola = Auth::user()->scuola;
                        $stepData['sections'][$section]['fields'][$fieldName]['value'] =
                            $scuola->getKey();
                    }

                    if ($scuola) {
                        $stepData['sections'][$section]['fields'][$fieldName]['referred_data']
                            = $scuola->getScuolaFE();
                        $stepData['sections'][$section]['fields'][$fieldName]['referred_data_full']
                            = $scuola->getScuolaFE(true);

                    }
                }
            }
        }
        return $stepData;
    }

    protected function checkUserCreate(Request $request, Iniziativa $iniziativa)
    {

        $role = auth_role_name();
        $this->role = $role;

        switch ($role) {
            case 'Admin':
            case 'Superutente':
                return true;
            case 'Studente':
                $maxCandidature = 1;
                break;
            case 'Scuola':
                $scuola = (Auth::user())->scuola;
                if (!$scuola || !$scuola->getKey()) {
                    return false;
                }
                $maxCandidature = $iniziativa->max_candidature_scuola;
                break;
            default:
                return false;
        }
        if (is_null($maxCandidature)) {
            return true;
        }
        $countCandidature = Candidato::where('iniziativa_id', $iniziativa->getKey())
            ->where('user_id', Auth::id())
            ->count();
         if ($countCandidature < $maxCandidature) {
            return true;
        }
        return false;


    }

    protected function checkUserEdit(Request $request, Candidato $candidatura, $edit = true)
    {

        $role = auth_role_name();
        $this->role = $role;

        if ($edit && ($candidatura->status != CandidatoStatuses::BOZZA->value)) {
            return false;
        }
        if (!$edit && ($candidatura->status == CandidatoStatuses::BOZZA->value)) {
            return false;
        }
        switch ($role) {
            case 'Admin':
            case 'Superutente':
                return true;
            default:
                $candidatoPolicy = new CandidatoPolicy();
                if ($edit) {
                    return $candidatoPolicy->update(Auth::user(),$candidatura);
                }
                return $candidatoPolicy->view(Auth::user(),$candidatura);
        }

    }

    public function create(Request $request, Iniziativa $iniziativa)
    {

        if (!$this->checkUserCreate($request, $iniziativa)) {
            return redirect()->route('candidature');
        }


        $step = 1;
        $candidaturaTitle = $iniziativa->titolo;
        $steps = $this->steps;

        $foorm = Foorm::getFoorm('candidato.insert', $request, []);
        $metadata = $foorm->getFormMetadata();
        $data = $foorm->getFormData();


        $req = $request->all();

        $steps[$step] = $this->setOptionsInStepData($steps[$step], $metadata);
        $steps[$step] = $this->setValuesInStepData($steps[$step], $data);
        return view('candidature.create', compact('iniziativa', 'candidaturaTitle', 'steps', 'step', 'req'));
    }

    public function store(Request $request, Iniziativa $iniziativa)
    {
        if (!$this->checkUserCreate($request, $iniziativa)) {
            return redirect()->route('candidature');
        }

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
            if ($submitType == 'next') {
                $step++;
            }
            $steps[$step] = $this->setValuesInStepData($steps[$step], $data);
        }
        $steps[$step] = $this->setOptionsInStepData($steps[$step], $metadata);
        return view('candidature.edit', compact('candidatura', 'iniziativa', 'candidaturaTitle', 'steps', 'step', 'req'));
    }

    public function edit(Request $request, Candidato $candidatura, $step = 1)
    {
        if (!$this->checkUserEdit($request, $candidatura)) {
            return redirect()->route('candidature');
        }

        $iniziativa = $candidatura->iniziativa;
        $candidaturaTitle = $iniziativa->titolo;
        $steps = $this->steps;
        $req = $request->all();

        $foorm = Foorm::getFoorm('candidato.edit', $request, ['id' => $candidatura->getKey()]);

        $metadata = $foorm->getFormMetadata();
        $data = $foorm->getFormData();

        $steps[$step] = $this->setOptionsInStepData($steps[$step], $metadata);
        $steps[$step] = $this->setValuesInStepData($steps[$step], $data);

        $candidatura = $candidatura->fresh();

        return view('candidature.edit', compact('candidatura', 'iniziativa', 'candidaturaTitle', 'steps', 'step', 'req'));
    }

    public function update(Request $request, Candidato $candidatura)
    {
        if (!$this->checkUserEdit($request, $candidatura)) {
            return redirect()->route('candidature');
        }

        $step = $request->get('step');
        $iniziativa = $candidatura->iniziativa;
        $candidaturaTitle = $iniziativa->titolo;
        $steps = $this->steps;
        $req = $request->all();
        $submitType = $request->get('submit-type', 'save');


        $foorm = Foorm::getFoorm('candidato.edit', $request, ['id' => $candidatura->getKey()]);
        $errors = new MessageBag();
        try {
            if ($submitType == 'invia') {
                if (!$candidatura->data_candidatura) {
                    $candidatura->data_candidatura = now()->toDateString();
                }
                $candidatura->makeTransitionAndSave('inviata');
                $view = 'candidature.view';
            } else {
                $foorm->save();
                $view = 'candidature.edit';
            }
        } catch (ValidationException $e) {

            $req = $this->manageReqOnError($req);

            return redirect(route('candidatura.edit', [
                'candidatura' => $candidatura->getKey(),
                'step' => $step,
            ]))->withInput($req)
                ->withErrors($e->errors());
        }

        $metadata = $foorm->getFormMetadata();
        $data = $foorm->getFormData();


        if ($submitType == 'next') {
            $step++;
        }
        $steps[$step] = $this->setOptionsInStepData($steps[$step], $metadata);
        $steps[$step] = $this->setValuesInStepData($steps[$step], $data);

        $candidatura = $candidatura->fresh();

        return view($view, compact('candidatura', 'iniziativa', 'candidaturaTitle', 'steps', 'step', 'req', 'errors'));

    }

    public function view(Request $request, Candidato $candidatura)
    {
        if (!$this->checkUserEdit($request, $candidatura, false)) {
            return redirect()->route('candidature');
        }

        $step = count($this->steps) - 1;
        $iniziativa = $candidatura->iniziativa;
        $candidaturaTitle = $iniziativa->titolo;
        $steps = $this->steps;
        $req = $request->all();
        $foorm = Foorm::getFoorm('candidato.edit', $request, ['id' => $candidatura->getKey()]);

        $metadata = $foorm->getFormMetadata();
        $data = $foorm->getFormData();


        $steps[$step] = $this->setOptionsInStepData($steps[$step], $metadata);
        $steps[$step] = $this->setValuesInStepData($steps[$step], $data);

        return view('candidature.view', compact('candidatura', 'iniziativa', 'candidaturaTitle', 'steps', 'step', 'req'));

    }

    protected function manageReqOnError($req) {
        $hasVoti = isset($req['voti-id']) && is_array($req['voti-id']);

        if($hasVoti) {
            $req['voti'] = $this->buildVoti($req);
        }

        $scuolaId = Arr::get($req,'scuola_id');
        if ($scuolaId) {
            $scuola = Scuola::find($scuolaId);
            if ($scuola) {
                $req['scuola_referred_data'] = $scuola->getScuolaFE();
                $req['scuola_referred_data_full'] = $scuola->getScuolaFE(true);
            }
        }

        return $req;
    }
    protected function buildVoti($req) {
        $voti = [];
        foreach ($req['voti-id'] as $key => $votoId) {
            $voto['id'] = $votoId;
            $voto['materia_id'] = $req['voti-materia_id'][$key];
            $voto['voto_anno_2'] = $req['voti-voto_anno_2'][$key];
            $voto['voto_anno_1'] = $req['voti-voto_anno_1'][$key];
            $voto['voto_primo_quadrimestre'] = $req['voti-voto_primo_quadrimestre'][$key];
            $voti[] = $voto;
        }
        return $voti;
    }
}
