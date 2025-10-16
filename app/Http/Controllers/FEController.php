<?php

namespace App\Http\Controllers;

use App\Models\Avviso;
use App\Models\Classe;
use App\Models\Copertina;
use App\Models\Corso;
use App\Models\Evento;
use App\Models\Iniziativa;
use App\Models\MateriaOrientamento;
use App\Models\News;
use App\Models\Pagina;
use App\Models\PaginaInfo;
use App\Models\PaginaOrientamento;
use App\Models\SezioneLayout;
use App\Models\StudenteOrientamento;
use App\Models\Video;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Igaster\LaravelTheme\Facades\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use willvincent\Feeds\Facades\FeedsFacade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FEController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Theme::set('sns');
    }

    protected function getFeeds()
    {

        $f = FeedsFacade::make(Config::get('feeds.url'), 3, true);
        //        $data = array(
        //            'title'     => $feed->get_title(),
        //            'permalink' => $feed->get_permalink(),
        //            'items'     => $feed->get_items(),
        //        );

        //        echo count($f->get_items()) . "<br/>";


        $response = Arr::get(Arr::get(Arr::get($f->data, 'child', []), "", []), 'response', []);
        $items    = Arr::get(Arr::get(Arr::get(Arr::get($response, 0, []), "child", []), "", []), 'item', []);

        $news = [];

        foreach ($items as $item) {
            $itemData = Arr::get(Arr::get($item, 'child', []), "", []);

            $singleNews = [];

            $singleNews['title'] = html_entity_decode(Arr::get(Arr::get(Arr::get($itemData, 'title', []), 0, []), 'data'));
            $singleNews['link']  = Arr::get(Arr::get(Arr::get($itemData, 'link', []), 0, []), 'data');
            $singleNews['date']  = Carbon::parse(Arr::get(Arr::get(Arr::get($itemData, 'pubDate', []), 0, []), 'data'))->toDateTimeString();
            $singleNews['media'] = Arr::get(Arr::get(Arr::get($itemData, 'media', []), 0, []), 'data');

            $news[] = $singleNews;
            if (count($news) >= 3) {
                break;
            }
        }

        return $news;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pagine = PaginaOrientamento::where('attivo', 1)
            ->where('homepage', 1)
            ->orderBy('ordine', 'ASC')
            //Rimuovo il limit
            //->limit(6)
            ->get();

        $news = News::where('attivo', 1)
            ->whereNotNull('evidenza')
            ->orderBy('evidenza', 'ASC')
            ->limit(4)
            ->get();

        $corsi = Corso::where('attivo', 1)
            ->where('homepage', 1)
            ->orderBy('titolo', 'ASC')
            ->get();

        $feeds = $this->getFeeds();

        $avvisi = Avviso::where('attivo', 1)->get();

        $newsBasse = $news->where('evidenza', '>', 1)->all();

        $eventi         = Evento::where('attivo', 1)
            ->whereIn('evidenza', [1, 2, 3])
            ->orderBy('evidenza', 'ASC')
            ->get();
        $eventoSpeciale = Evento::where('attivo', 1)
            ->where('evidenza', 9)
            ->first();

        $video = Video::where('attivo', 1)
            ->where('homepage', 1)
            ->orderBy('ordine', 'ASC')
            ->limit(3)
            ->get();

        $copertina = Copertina::find(1);

        return view('index', compact(
            'pagine',
            'newsBasse',
            'eventi',
            'eventoSpeciale',
            'avvisi',
            'video',
            'feeds',
            'copertina',
            'corsi'
        ));
    }

    public function paginaOrientamento(Request $request, PaginaOrientamento $pagina)
    {

        $navleft     = [
            'sezioni'  => $pagina->sezioni,
            'allegati' => $pagina->attachments,
        ];
        $breadcrumbs = [
            'Home'             => '/',
            'Orientamento'     => '/orientamento',
            $pagina->titolo_it => '#',
        ];
        $headTitle = $pagina->titolo_it;
        return view('pagina-orientamento', compact('pagina', 'navleft', 'breadcrumbs','headTitle'));
    }

    public function pagina(Request $request, Pagina $pagina)
    {

        $navleft     = [
            'sezioni'  => $pagina->sezioni,
            'allegati' => $pagina->attachments,
        ];
        $breadcrumbs = [
            'Home'             => '/',
            $pagina->titolo_it => '#',
        ];
        $headTitle = $pagina->titolo_it;
        return view('pagina', compact('pagina', 'navleft', 'breadcrumbs','headTitle'));
    }

    public function sportelloStudenti(Request $request)
    {

        $descrizione = SezioneLayout::where('codice', 'sportello-studenti-intro')->firstOrNew();
        $classi      = Classe::all();
        $studentiTotali = StudenteOrientamento::where('attivo', 1)->count();
        if ($studentiTotali == 0) {
            $classi = [];
        }
        $breadcrumbs = [
            'Home'                             => '/',
            'Sportello da studente a studente' => '#',
        ];
        $headTitle = 'Sportello da studente a studente';

        return view('sportello-studenti', compact('descrizione', 'classi', 'breadcrumbs','headTitle'));
    }

    public function orientamento(Request $request)
    {

        $descrizione = SezioneLayout::where('codice', 'orientamento-intro')->firstOrNew();
        $pagine      = PaginaOrientamento::where('attivo', 1)->orderBy('ordine', 'ASC')->orderBy('titolo_it', 'ASC')->get();
        $breadcrumbs = [
            'Home'         => '/',
            'Orientamento' => '#',
        ];
        $headTitle = 'Orientamento';
        return view('orientamento', compact('descrizione', 'pagine', 'breadcrumbs','headTitle'));
    }

    public function infoCorsi(Request $request, PaginaInfo $pagina = null)
    {

        $iniziative  = Iniziativa::with('corsi')
            ->where('attivo', 1)
            ->whereDate('data_apertura', '<=', date('Y-m-d'))
            ->whereDate('data_chiusura', '>=', date('Y-m-d'))
            ->orderBy('data_apertura', 'ASC')
            ->get();
        $descrizione = SezioneLayout::where('codice', 'info-corsi-intro')->firstOrNew();
        $pagine      = PaginaInfo::where('attivo', 1)->orderBy('ordine', 'ASC')->orderBy('titolo_it', 'ASC')->get();

        $navleft = [];
        if ($pagina) {
            $navleft = [
                'sezioni'  => $pagina->sezioni,
                'allegati' => $pagina->attachments,
            ];
        }
        $navleftInfo = [
            'pagine' => $pagine->pluck('slug_it', 'id')->all(),
        ];
        $breadcrumbs = [
            'Home'       => '/',
            'Info corsi' => '#',
        ];
        $headTitle = "Info corsi";

        return view('info-corsi', compact('descrizione', 'navleftInfo', 'pagine', 'breadcrumbs', 'pagina', 'navleft', 'iniziative','headTitle'));
    }

    public function infoCorso(Request $request, Corso $corso)
    {

        if (!$corso->homepage) {
            return redirect(RouteServiceProvider::HOME);
        }
        $iniziative = Iniziativa::with('corsi')
            ->where('attivo', 1)
            ->whereDate('data_apertura', '<=', date('Y-m-d'))
            ->whereDate('data_chiusura', '>=', date('Y-m-d'))
            ->orderBy('data_apertura', 'ASC')
            ->get();

        $corsi = Corso::where('attivo', 1)
            ->where('homepage', 1)
            ->orderBy('titolo', 'ASC')
            ->get();

        $descrizione = SezioneLayout::where('codice', 'info-corsi-intro')->firstOrNew();
        $pagine      = PaginaInfo::where('attivo', 1)->orderBy('ordine', 'ASC')->orderBy('titolo_it', 'ASC')->get();

        $navleft     = [
            'allegati' => $corso->attachments,
        ];
        $navleftInfo = [
            'pagine' => $pagine->pluck('slug_it', 'id')->all(),
        ];
        $breadcrumbs = [];
        $breadcrumbs['Home'] = '/';
        if ($pagine->count() > 0) {
            $breadcrumbs['Info corsi'] = '/info-corsi';
        }
        $breadcrumbs[$corso->titolo] = '#';
        $headTitle = "Info corso " . $corso->titolo;
        return view('info-corso', compact('descrizione', 'navleftInfo', 'pagine', 'breadcrumbs', 'corso', 'navleft', 'iniziative', 'corsi','headTitle'));
    }

    public function sportelloStudentiClasse(Request $request, Classe $classe)
    {

        $studenti = StudenteOrientamento::whereHas('materia', function ($q) use ($classe) {
            return $q->where('classe_id', $classe->id);
        })
            ->where('attivo', 1)
            ->get();

        $classi      = Classe::all();
        $breadcrumbs = [
            'Home'                             => '/',
            'Sportello da studente a studente' => '/sportello-studenti',
            'Tutor ' . $classe->nome_it => '/sportello-studenti/' . $classe->id,
        ];
        $headTitle = 'Tutor ' . $classe->nome_it . ' - ' . 'Sportello da studente a studente';
        return view('sportello-studenti-classe', compact('studenti', 'breadcrumbs','headTitle'));
    }


    protected function getArchivioItems(Request $request, $filter, $className)
    {

        $items = $className::where('attivo', 1);


        switch ($className) {
            case Video::class:
                $items->orderBy('titolo_it', 'DESC');
                if ($filter) {
                    $items->where(function ($q) use ($filter) {
                        return $q->where('titolo_it', 'LIKE', '%' . $filter . '%')
                            ->orWhere('descrizione_it', 'LIKE', '%' . $filter . '%');
                    });
                }
                $categoriaSelected = intval($request->get('video-categoria'));
                Log::info("CAT::::" . $categoriaSelected);
                if ($categoriaSelected > 0) {
                    $items->where('materia_id', $categoriaSelected);
                }
                break;
            default:
                $items = $items->orderBy('data', 'DESC');
                if ($filter) {
                    $items->where(function ($q) use ($filter) {
                        return $q->where('titolo_it', 'LIKE', '%' . $filter . '%')
                            ->orWhere('sottotitolo_it', 'LIKE', '%' . $filter . '%');
                    });
                }
                break;
        }

        $items = $items->paginate(Config::get('sns.per-page'))->withQueryString();

        return $items;
    }

    public
    function archivioNews(
        Request $request,
    ) {

        $filter = $request->get('filter');

        $items = $this->getArchivioItems($request, $filter, News::class);

        $breadcrumbs = [
            'Home'    => '/',
            'Notizie' => '#',
        ];
        $headTitle = "Notizie";
        return view('archivio-news', compact('items', 'filter', 'breadcrumbs','headTitle'));
    }

    public
    function archivioEventi(
        Request $request,
    ) {

        $filter = $request->get('filter');

        $items = $this->getArchivioItems($request, $filter, Evento::class);

        $breadcrumbs = [
            'Home'   => '/',
            'Eventi' => '#',
        ];
        $headTitle = "Eventi";
        return view('archivio-eventi', compact('items', 'filter', 'breadcrumbs','headTitle'));
    }


    public
    function archivioVideo(
        Request $request,
    ) {

        $descrizione = SezioneLayout::where('codice', 'video-intro')->firstOrNew();

        $filter            = $request->get('filter');
        $categoriaSelected = $request->get('video-categoria');

        $items = $this->getArchivioItems($request, $filter, Video::class);

        $categorie = (new MateriaOrientamento())->getForSelectList();

        //        $items = $this->getArchivioItems($request,$filter,Video::class);

        $breadcrumbs = [
            'Home'  => '/',
            'Video' => '#',
        ];
        $headTitle = "Video";
        return view('archivio-video', compact('items', 'filter', 'descrizione', 'breadcrumbs', 'categoriaSelected', 'categorie','headTitle'));
    }

    public
    function dettaglioNews(
        Request $request,
        News $notizia,
    ) {

        $navleft     = [
            'sezioni'   => $notizia->sezioni,
            'data_news' => $notizia->data,
            'allegati'  => $notizia->attachments,
        ];
        $breadcrumbs = [
            'Home'              => '/',
            'Notizie'           => '/archivio-news',
            $notizia->titolo_it => '#',
        ];
        return view('dettaglio-news', compact('notizia', 'navleft', 'breadcrumbs'));
    }

    public
    function dettaglioEvento(
        Request $request,
        Evento $evento,
    ) {

        $navleft     = [
            'sezioni'          => $evento->sezioni,
            'luogo_evento'     => $evento->luogo,
            'data_evento'      => $evento->data,
            'orario_evento'    => $evento->orario,
            'data_fine_evento' => $evento->data_fine,
            'allegati'         => $evento->attachments,
        ];
        $breadcrumbs = [
            'Home'             => '/',
            'Notizie'          => '/archivio-eventi',
            $evento->titolo_it => '#',
        ];
        return view('dettaglio-evento', compact('evento', 'navleft', 'breadcrumbs'));
    }

    public
    function scuolaRichiestaCortesia(
        Request $request,
    ) {
        return view('cortesia-scuola-richiesta');
    }

    public function chat()
    {
        // Don't touch this ...
        try {
            $chatManifest     = file_get_contents(public_path('chat/manifest.json'));
            $chatManifestJSON = json_decode($chatManifest, true);
            $JSAssets         = $chatManifestJSON['entries']['index']['initial']['js'] ?? [];
            $CSSAssets        = $chatManifestJSON['entries']['index']['initial']['css'] ?? [];
        } catch (\Throwable $th) {
            $JSAssets  = [];
            $CSSAssets = [];
        }
        // ...to this
        $userAvatar             = '';
        $faqs = [
            'title' => 'Qualche argomento di cui posso parlarti:',
            'questions' => [
                [
                    'heading' => 'Domande studenti',
                    'items' => [
                        ['title' => 'Cosa sono i corsi di orientamento della Scuola Normale Superiore?'],
                        ['title' => 'Quali sono gli obiettivi principali dei corsi di orientamento?'],
                        ['title' => 'Quali sono le tematiche principali trattate nei corsi di orientamento?'],
                        ['title' => 'I corsi di orientamento sono incentrati su materie specifiche o sono interdisciplinari?'],
                        ['title' => 'I corsi di orientamento sono incentrati su materie insegnate alla Normale?'],
                        ['title' => 'Quando si svolgono i corsi di orientamento?'],
                        ['title' => 'Quali sono i criteri di selezione ai corsi di orientamento?'],
                        ['title' => 'La Scuola offre vitto e alloggio per chi partecipa ai corsi?'],
                        ['title' => 'Che differenza c’è tra \'Settimane orientamento\' e \'Scuola Orientamento\'?'],
                    ],
                ],
                [
                    'heading' => 'Domande genitori',
                    'items' => [
                        ['title' => 'Cosa sono i corsi di orientamento organizzati dalla Scuola Normale Superiore?'],
                        ['title' => 'Quali sono gli obiettivi principali di questi corsi di orientamento?'],
                        ['title' => 'A chi sono rivolti i corsi di orientamento?'],
                        ['title' => 'Quanti studenti partecipano ogni anno ai corsi di orientamento?'],
                        ['title' => 'Quali sono i temi principali trattati durante i corsi di orientamento?'],
                        ['title' => 'Se mio figlio viene scelto, quanto impegno richiedono questi corsi di orientamento?'],
                        ['title' => 'È necessario avere conoscenze o competenze specifiche per partecipare ai corsi di orientamento?'],
                        ['title' => 'Il corso di orientamento è adatto anche a chi viene da piccole scuole o paesi?'],
                        ['title' => 'Mio figlio non è mai stato fuori casa da solo. Sarebbe seguito e accompagnato durante i corsi di orientamento?'],
                        ['title' => 'Quali sono i criteri di selezione ai corsi di orientamento per gli studenti?'],
                        ['title' => 'Come si invia la candidatura ai corsi di orientamento e quali documenti sono necessari?'],
                        ['title' => 'Entro quando bisogna presentare la domanda di iscrizione ai corsi di orientamento?'],
                        ['title' => 'Posso presentare la domanda ai corsi di orientamento per conto di mio figlio/figlia?'],
                        ['title' => 'I corsi trattano argomenti specifici delle discipline scientifiche, umanistiche o entrambi?'],
                        ['title' => 'Chi sono i docenti che tengono le lezioni dei corsi di orientamento? Si tratta di professori della Scuola Normale o di esperti esterni?'],
                        ['title' => 'Come posso contattare la Scuola Normale per ricevere ulteriori dettagli o chiarimenti sui corsi di orientamento?'],
                    ],
                ],
            ],
        ];
        $questionsTitle = 'Prova a farmi queste domande...';
        $pageTitle              = 'Parla con noi';
        $chatTitle = 'Chiedi al nostro chatbot!';
        $info = [
            'items' => [
                [
                    'bsIcon' => 'info-circle',
                    'title' => 'Parla con noi',
                    'text' => 'Se preferite interagire con un operatore o operatrice o avete esigenze specifiche, vi invitiamo a contattarci direttamente ai seguenti recapiti, durante gli orari di ufficio:',
                ],
                [
                    'bsIcon' => 'clock',
                    'title' => 'Orari ufficio',
                    'list' => [
                        [
                            'key' => 'Lunedì - Venerdì:',
                            'value' => '09:30 - 12:30',
                        ],
                        [
                            'key' => 'Lunedì, Martedì, Mercoledì, Giovedì:',
                            'value' => '14:30 - 16:30',
                        ],
                    ],
                ],
                [
                    'bsIcon' => 'ear',
                    'title' => 'Scrivi o chiama',
                    'list' => [
                        [
                            'key' => 'Email:',
                            'value' => 'orientamento@sns.it',
                            'valueType' => 'email',
                        ],
                        [
                            'key' => 'Telefono:',
                            'value' => '+39 050 50 9307 / 9670 / 9057 / 9493',
                        ],
                        [
                            'key' => 'Cellulare:',
                            'value' => '+39 331 6990724 / +39 347 1092201',
                        ],
                    ],
                    'text' => 'Siamo a vostra disposizione per qualsiasi ulteriore informazione! Vi auguriamo una piacevole esperienza di consultazione e un buon percorso di orientamento presso la Scuola Normale Superiore.',
                ],
            ],
        ];
        $firstAnswer = 'Ciao e benvenuti e benvenute nel chatbot informativo dei Corsi di Orientamento della Scuola Normale Superiore! Sono qui per darti una mano con tutte le informazioni di cui hai bisogno per orientarti nelle tue scelte di studio. Fai pure le tue domande, e cercherò di risponderti in modo veloce e chiaro.';

        return view('sns.chat', [
            'assets'                 => [
                'js'  => $JSAssets,
                'css' => $CSSAssets,
            ],
            'userAvatar'             => $userAvatar,
            'faqs'              => collect($faqs),
            'pageTitle'              => $pageTitle,
            'firstAnswer'            => $firstAnswer,
            'questionsTitle'         => $questionsTitle,
            'info'                   => collect($info),
            'chatTitle'              => $chatTitle,
            'headTitle'              => "Parla con noi",
        ]);
    }
}
