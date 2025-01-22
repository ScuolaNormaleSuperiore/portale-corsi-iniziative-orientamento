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
use Carbon\Carbon;
use Igaster\LaravelTheme\Facades\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
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

        foreach ($items as $item)
        {
            $itemData = Arr::get(Arr::get($item, 'child', []), "", []);

            $singleNews = [];

            $singleNews['title'] = html_entity_decode(Arr::get(Arr::get(Arr::get($itemData, 'title', []), 0, []), 'data'));
            $singleNews['link']  = Arr::get(Arr::get(Arr::get($itemData, 'link', []), 0, []), 'data');
            $singleNews['date']  = Carbon::parse(Arr::get(Arr::get(Arr::get($itemData, 'pubDate', []), 0, []), 'data'))->toDateTimeString();
            $singleNews['media'] = Arr::get(Arr::get(Arr::get($itemData, 'media', []), 0, []), 'data');

            $news[] = $singleNews;
            if (count($news) >= 3)
            {
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
            ->limit(6)
            ->get();

        $news = News::where('attivo', 1)
            ->whereNotNull('evidenza')
            ->orderBy('evidenza', 'ASC')
            ->limit(4)
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
        return view('pagina-orientamento', compact('pagina', 'navleft', 'breadcrumbs'));
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
        return view('pagina', compact('pagina', 'navleft', 'breadcrumbs'));
    }

    public function sportelloStudenti(Request $request)
    {

        $descrizione = SezioneLayout::where('codice', 'sportello-studenti-intro')->firstOrNew();
        $classi      = Classe::all();
        $breadcrumbs = [
            'Home'                             => '/',
            'Sportello Da Studente a Studente' => '#',
        ];
        return view('sportello-studenti', compact('descrizione', 'classi', 'breadcrumbs'));
    }

    public function orientamento(Request $request)
    {

        $descrizione = SezioneLayout::where('codice', 'orientamento-intro')->firstOrNew();
        $pagine      = PaginaOrientamento::where('attivo', 1)->orderBy('ordine', 'ASC')->orderBy('titolo_it', 'ASC')->get();
        $breadcrumbs = [
            'Home'         => '/',
            'Orientamento' => '#',
        ];
        return view('orientamento', compact('descrizione', 'pagine', 'breadcrumbs'));
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
        if ($pagina)
        {
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

        return view('info-corsi', compact('descrizione', 'navleftInfo', 'pagine', 'breadcrumbs', 'pagina', 'navleft', 'iniziative'));
    }

    public function infoCorso(Request $request, Corso $corso)
    {

        $iniziative = Iniziativa::with('corsi')
            ->where('attivo', 1)
            ->whereDate('data_apertura', '<=', date('Y-m-d'))
            ->whereDate('data_chiusura', '>=', date('Y-m-d'))
            ->orderBy('data_apertura', 'ASC')
            ->get();

        $descrizione = SezioneLayout::where('codice', 'info-corsi-intro')->firstOrNew();
        $pagine      = PaginaInfo::where('attivo', 1)->orderBy('ordine', 'ASC')->orderBy('titolo_it', 'ASC')->get();

        $navleft     = [
            'allegati' => $corso->attachments,
        ];
        $navleftInfo = [
            'pagine' => $pagine->pluck('slug_it', 'id')->all(),
        ];
        $breadcrumbs = [
            'Home'         => '/',
            'Info corsi'   => '/info-corsi',
            $corso->titolo => '#',
        ];

        return view('info-corso', compact('descrizione', 'navleftInfo', 'pagine', 'breadcrumbs', 'corso', 'navleft', 'iniziative'));
    }

    public function sportelloStudentiClasse(Request $request, Classe $classe)
    {

        $studenti = StudenteOrientamento::whereHas('materia', function ($q) use ($classe)
        {
            return $q->where('classe_id', $classe->id);
        })
            ->where('attivo', 1)
            ->get();

        $classi      = Classe::all();
        $breadcrumbs = [
            'Home'                             => '/',
            'Sportello Da Studente a Studente' => '/sportello-studenti',
            'Tutor ' . $classe->nome_it => '/sportello-studenti/' . $classe->id,
        ];
        return view('sportello-studenti-classe', compact('studenti', 'breadcrumbs'));
    }


    protected function getArchivioItems(Request $request, $filter, $className)
    {

        $items = $className::where('attivo', 1);


        switch ($className)
        {
            case Video::class:
                $items->orderBy('titolo_it', 'DESC');
                if ($filter)
                {
                    $items->where(function ($q) use ($filter)
                    {
                        return $q->where('titolo_it', 'LIKE', '%' . $filter . '%')
                            ->orWhere('descrizione_it', 'LIKE', '%' . $filter . '%');
                    });
                }
                $categoriaSelected = intval($request->get('video-categoria'));
                Log::info("CAT::::" . $categoriaSelected);
                if ($categoriaSelected > 0)
                {
                    $items->where('materia_id', $categoriaSelected);
                }
                break;
            default:
                $items = $items->orderBy('data', 'DESC');
                if ($filter)
                {
                    $items->where(function ($q) use ($filter)
                    {
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
        return view('archivio-news', compact('items', 'filter', 'breadcrumbs'));
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
        return view('archivio-eventi', compact('items', 'filter', 'breadcrumbs'));
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
        return view('archivio-video', compact('items', 'filter', 'descrizione', 'breadcrumbs', 'categoriaSelected', 'categorie'));
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
        try
        {
            $chatManifest     = file_get_contents(public_path('chat/manifest.json'));
            $chatManifestJSON = json_decode($chatManifest, true);
            $JSAssets         = $chatManifestJSON['entries']['index']['initial']['js'] ?? [];
            $CSSAssets        = $chatManifestJSON['entries']['index']['initial']['css'] ?? [];
        }
        catch (\Throwable $th)
        {
            $JSAssets  = [];
            $CSSAssets = [];
        }
        // ...to this
        $userAvatar             = '';
        $faqs              = [
            'title' => 'Qualche argomento di cui posso parlarti:',
            'questions' => [
                [
                    'heading' => 'Domande per i genitori',
                    'items' => [
                        'Ciao, come posso aiutarti?',
                        'Ciao, come posso aiutarti?',
                        'Ciao, come posso aiutarti?',
                        'Ciao, come posso aiutarti?',
                    ],
                ],
                [
                    'heading' => 'Domande per gli studenti',
                    'items' => [
                        'Ciao, come posso aiutarti?',
                        'Ciao, come posso aiutarti?',
                        'Ciao, come posso aiutarti?',
                        'Ciao, come posso aiutarti?',
                    ],
                ],
            ],
        ];
        $pageTitle              = 'Parla con noi';
        $firstAnswer            = 'Ciao, come posso aiutarti?';
        return view('sns.chat', [
            'assets'                 => [
                'js'  => $JSAssets,
                'css' => $CSSAssets,
            ],
            'userAvatar'             => $userAvatar,
            'faqs'              => collect($faqs),
            'pageTitle'              => $pageTitle,
            'firstAnswer'            => $firstAnswer,
        ]);
    }

}
