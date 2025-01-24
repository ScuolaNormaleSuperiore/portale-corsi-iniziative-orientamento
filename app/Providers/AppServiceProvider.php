<?php

namespace App\Providers;

use App\Models\Pagina;
use App\Models\PaginaOrientamento;
use Gecche\Cupparis\App\Foorm\FoormManager;
use Gecche\Cupparis\Menus\Facades\Menus;
use Igaster\LaravelTheme\Facades\Theme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        //
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Schema::defaultStringLength(191);
        //
        $headerActive = $this->calculateHeaderActive();
        $headerMenuPrincipale = [
            'orientamento' => [
                'path' => '/orientamento',
                'title' => 'Orientamento',
            ],
            'eventi' => [
                'path' => '/archivio-eventi',
                'title' => 'Eventi',
            ],
//            'info-corsi' => [
//                'path' => '/info-corsi',
//                'title' => 'Info sui corsi',
//            ],
            'candidature' => [
                'path' => '/candidature',
                'title' => 'Per candidarsi',
            ],
        ];
        $headerMenuSecondario = [
            'chat' => [
                'path' => '/chat',
                'title' => 'Parla con noi',
            ],
            'sportello-studenti' => [
                'path' => '/sportello-studenti',
                'title' => 'Sportello da studente a Studente',
            ],
        ];
        if ($headerActive && isset($headerMenuPrincipale[$headerActive])) {
            $headerMenuPrincipale[$headerActive]['active'] = true;
        }
        if ($headerActive && isset($headerMenuSecondario[$headerActive])) {
            $headerMenuSecondario[$headerActive]['active'] = true;
        }



        View::composer(['*'], function ($view) use ($headerMenuPrincipale,$headerMenuSecondario) {
            $authRole = Auth::id() ? Auth::user()?->mainrole : null;
            $view->with('headerMenuPrincipale', $headerMenuPrincipale);
            $view->with('headerMenuSecondario', $headerMenuSecondario);
            $view->with('authRole', $authRole);
            $view->with('layoutGradientColor', 'bg-gradient-info overlay-dark overlay-opacity-4');
            $role = auth_role();
            $view->with('ruolo', $role);
            switch ($role) {
                case 'Superutente':
                case 'Admin':
                    $dashboardType = 'admin';
                    break;
                default:
                    $dashboardType = strtolower($role);
                    break;
            }
            $view->with('dashboardType', $dashboardType);
            $view->with('cupparisMenus', $this->getMenuByRole());

            $orientamentoFooter = PaginaOrientamento::where('attivo', 1)->orderBy('ordine')->get();

            $i = 1;
            $orientamentoFooterArray = [
                1 => collect(),
                2 => collect(),
                3 => collect(),
            ];
            foreach ($orientamentoFooter as $element) {
                $index = ($i % 3) + 1;
                $orientamentoFooterCollection = $orientamentoFooterArray[$index];
                $orientamentoFooterArray[$index] = $orientamentoFooterCollection->push($element);
            }

            $view->with('orientamentoFooterArray', $orientamentoFooterArray);
        });
        Validator::extend('username_email', 'App\Validation\Rules@usernameEmail');

    }

    protected function calculateHeaderActive() {
//        if (Theme::get() != 'sns') {
//            return null;
//        }
        $uri = request()->getRequestUri();

        if (Str::startsWith($uri,['/orientamento','/pagina-orientamento'])) {
            return 'orientamento';
        }
        if (Str::startsWith($uri, ['/archivio-eventi','/dettaglio-evento'])) {
            return 'eventi';
        }
        if (Str::startsWith($uri, ['/info-corsi','/info-corso'])) {
            return 'info-corsi';
        }
        if (Str::startsWith($uri, ['/candidatura','/candidature'])) {
            return 'candidature';
        }
        if (Str::startsWith($uri, ['/sportello-studenti'])) {
            return 'sportello-studenti';
        }
        if (Str::startsWith($uri, ['/chat'])) {
            return 'chat';
        }


        return $uri;
    }

    protected function getMenuByRole()
    {


        $menuIds = null;
        switch (auth_role()) {
            case 'Superutente':
                $menuIds = [];
//                $menuIds = ['Admin'];
                break;
            case 'Admin':
                $menuIds = [];
                break;
            default:
                $menuIds = [];
                break;
        }

        if (is_array($menuIds)) {
            $menus = [];
            foreach ($menuIds as $menu) {
                $menus = array_merge($menus, Menus::getMenuData($menu, true));
            }
        } else {
            $menus = Menus::getMenuData(null, true);
        }


        return $menus;
    }

}
