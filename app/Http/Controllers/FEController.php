<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Evento;
use App\Models\News;
use App\Models\Pagina;
use App\Models\SezioneLayout;
use App\Models\StudenteOrientamento;
use Igaster\LaravelTheme\Facades\Theme;
use Illuminate\Http\Request;

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
        $pagine = Pagina::where('attivo', 1)
            ->where('homepage', 1)
            ->orderBy('ordine', 'ASC')
            ->limit(6)
            ->get();

        $news = News::where('attivo', 1)
            ->whereNotNull('evidenza')
            ->orderBy('evidenza', 'ASC')
            ->get();

        $newsAlta = $news->where('evidenza', 1)->first();

        $newsBasse = $news->where('evidenza', '>', 1)->all();

        $eventi = Evento::where('attivo', 1)
            ->whereNotNull('evidenza')
            ->orderBy('evidenza', 'ASC')
            ->get();

        return view('index', compact('pagine', 'newsAlta', 'newsBasse', 'eventi'));
    }

    public function paginaOrientamento(Request $request, Pagina $pagina)
    {

        $navleft = ['sezioni' => $pagina->sezioni];
        $breadcrumbs = [
            'Home' => '/',
            'Orientamento' => '/',
            $pagina->titolo_it => '#',
        ];
        return view('pagina-orientamento', compact('pagina', 'navleft', 'breadcrumbs'));
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

}
