<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Evento;
use App\Models\News;
use App\Models\Pagina;
use App\Models\PaginaOrientamento;
use App\Models\SezioneLayout;
use App\Models\StudenteOrientamento;
use App\Models\Video;
use Igaster\LaravelTheme\Facades\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

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

        $newsAlta = $news->where('evidenza', 1)->first();

        $newsBasse = $news->where('evidenza', '>', 1)->all();

        $eventi = Evento::where('attivo', 1)
            ->whereNotNull('evidenza')
            ->orderBy('evidenza', 'ASC')
            ->get();

        return view('index', compact('pagine', 'newsAlta', 'newsBasse', 'eventi'));
    }

    public function paginaOrientamento(Request $request, PaginaOrientamento $pagina)
    {

        $navleft = [
            'sezioni' => $pagina->sezioni->whereNotNull('nome_it')->all(),
            'allegati' => $pagina->attachments,
        ];
        $breadcrumbs = [
            'Home' => '/',
            'Orientamento' => '/',
            $pagina->titolo_it => '#',
        ];
        return view('pagina-orientamento', compact('pagina', 'navleft', 'breadcrumbs'));
    }

    public function pagina(Request $request, Pagina $pagina)
    {

        $navleft = [
            'sezioni' => $pagina->sezioni->whereNotNull('nome_it')->all(),
            'allegati' => $pagina->attachments,
        ];
        $breadcrumbs = [
            'Home' => '/',
            $pagina->titolo_it => '#',
        ];
        return view('pagina', compact('pagina', 'navleft', 'breadcrumbs'));
    }

    public function sportelloStudenti(Request $request)
    {

        $descrizione = SezioneLayout::where('codice', 'sportello-studenti-intro')->firstOrNew();
        $classi = Classe::all();
        $breadcrumbs = [
            'Home' => '/',
            'Sportello Da Studente a Studente' => '#',
        ];
        return view('sportello-studenti', compact('descrizione', 'classi', 'breadcrumbs'));
    }

    public function orientamento(Request $request)
    {

        $descrizione = SezioneLayout::where('codice', 'orientamento-intro')->firstOrNew();
        $pagine = PaginaOrientamento::where('attivo',1)->orderBy('ordine','ASC')->orderBy('titolo_it','ASC')->get();
        $breadcrumbs = [
            'Home' => '/',
            'Orientamento' => '#',
        ];
        return view('orientamento', compact('descrizione', 'pagine', 'breadcrumbs'));
    }

    public function sportelloStudentiClasse(Request $request, Classe $classe)
    {

        $studenti = StudenteOrientamento::whereHas('materia', function ($q) use ($classe) {
            return $q->where('classe_id', $classe->id);
        })
            ->where('attivo', 1)
            ->get();

        $classi = Classe::all();
        $breadcrumbs = [
            'Home' => '/',
            'Sportello Da Studente a Studente' => '/sportello-studenti',
            'Tutor ' . $classe->nome_it => '/sportello-studenti/' . $classe->id,
        ];
        return view('sportello-studenti-classe', compact('studenti', 'breadcrumbs'));
    }


    protected function getArchivioItems(Request $request,$filter,$className) {

        $items = $className::where('attivo', 1)
            ->orderBy('data','DESC');

        if ($filter) {
            $items->where(function ($q) use ($filter) {
                return $q->where('titolo_it','LIKE', '%' . $filter . '%')
                    ->orWhere('sottotitolo_it','LIKE', '%' . $filter . '%');
            });
        }
        $items = $items->paginate(Config::get('sns.per-page'))->withQueryString();

        return $items;
    }

    public function archivioNews(Request $request) {

        $filter = $request->get('filter');

        $items = $this->getArchivioItems($request,$filter,News::class);

        $breadcrumbs = [
            'Home' => '/',
            'Notizie' => '#',
        ];
        return view('archivio-news', compact('items', 'filter','breadcrumbs'));
    }

    public function archivioEventi(Request $request) {

        $filter = $request->get('filter');

        $items = $this->getArchivioItems($request,$filter,Evento::class);

        $breadcrumbs = [
            'Home' => '/',
            'Eventi' => '#',
        ];
        return view('archivio-eventi', compact('items', 'filter','breadcrumbs'));
    }


    public function archivioVideo(Request $request) {

        $descrizione = SezioneLayout::where('codice', 'video-intro')->firstOrNew();
        $filter = $request->get('filter');

        $items = Video::where('attivo', 1)
            ->orderBy('ordine','ASC');

        if ($filter) {
            $items->where('titolo_it','LIKE', '%' . $filter . '%');
        }
        $items = $items->paginate(Config::get('sns.per-page'))->withQueryString();

//        $items = $this->getArchivioItems($request,$filter,Video::class);

        $breadcrumbs = [
            'Home' => '/',
            'Video' => '#',
        ];
        return view('archivio-video', compact('items', 'filter','descrizione','breadcrumbs'));
    }
    public function dettaglioNews(Request $request, News $notizia) {

        $navleft = [
            'sezioni' => $notizia->sezioni->whereNotNull('nome_it')->all(),
            'data_news' => $notizia->data,
            'allegati' => $notizia->attachments,
        ];
        $breadcrumbs = [
            'Home' => '/',
            'Notizie' => '/archivio-news',
            $notizia->titolo_it => '#',
        ];
        return view('dettaglio-news', compact('notizia', 'navleft', 'breadcrumbs'));
    }

    public function dettaglioEvento(Request $request, Evento $evento) {

        $navleft = [
            'sezioni' => $evento->sezioni->whereNotNull('nome_it')->all(),
            'luogo_evento' => $evento->luogo,
            'data_evento' => $evento->data,
            'orario_evento' => $evento->orario,
            'data_fine_evento' => $evento->data_fine,
            'allegati' => $evento->attachments,
        ];
        $breadcrumbs = [
            'Home' => '/',
            'Notizie' => '/archivio-eventi',
            $evento->titolo_it => '#',
        ];
        return view('dettaglio-evento', compact('evento', 'navleft', 'breadcrumbs'));
    }

    public function scuolaRichiestaCortesia(Request $request) {
        return view('cortesia-scuola-richiesta');
    }

}
