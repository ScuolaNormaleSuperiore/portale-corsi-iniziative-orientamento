<?php

namespace App\Http\Controllers;

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
            ->get();

        return view('index',compact('pagine'));
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
