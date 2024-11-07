<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\News;
use App\Models\Pagina;
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
        $pagine = Pagina::where('attivo',1)
            ->where('homepage',1)
            ->orderBy('ordine','ASC')
            ->limit(6)
            ->get();

        $news = News::where('attivo',1)
            ->whereNotNull('evidenza')
            ->orderBy('evidenza','ASC')
            ->get();

        $newsAlta = $news->where('evidenza',1)->first();

        $newsBasse = $news->where('evidenza','>',1)->all();

        $eventi = Evento::where('attivo',1)
            ->whereNotNull('evidenza')
            ->orderBy('evidenza','ASC')
            ->get();

        return view('index',compact('pagine','newsAlta', 'newsBasse', 'eventi'));
    }

    public function paginaOrientamento(Request $request, Pagina $pagina)
    {

        $navleft = ['sezioni' => $pagina->sezioni];
        $breadcrumbs = [
          'Home' => '/',
          'Orientamento' => '/',
          $pagina->titolo_it  => '#',
        ];
        return view('pagina-orientamento',compact('pagina','navleft', 'breadcrumbs'));
    }

}
