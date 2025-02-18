<?php

namespace App\Providers;

use App\Models\Pagina;
use App\Models\PaginaOrientamento;
use App\Models\SezioneLayout;
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
                'title' => 'Partecipa ai corsi',
            ],
        ];
        $headerMenuSecondario = [
            'chat' => [
                'path' => '/chat',
                'title' => 'Parla con noi',
            ],
            'sportello-studenti' => [
                'path' => '/sportello-studenti',
                'title' => 'Sportello da studente a studente',
            ],
        ];
        if ($headerActive && isset($headerMenuPrincipale[$headerActive])) {
            $headerMenuPrincipale[$headerActive]['active'] = true;
        }
        if ($headerActive && isset($headerMenuSecondario[$headerActive])) {
            $headerMenuSecondario[$headerActive]['active'] = true;
        }

        $socialLinks = [
            [
                'nome' => 'Instagram',
                'icona' => 'it-instagram',
                'link' => 'https://www.instagram.com/scuolanormale',
                'svg' => null,
            ],
            [
                'nome' => 'Bluesky',
                'icona' => null,
                'link' => 'https://bsky.app/profile/sns.it',
                'svg' => [
                    'fill' => "none",
                    'viewBox' => "0 0 64 57",
                    'path' => "M13.873 3.805C21.21 9.332 29.103 20.537 32 26.55v15.882c0-.338-.13.044-.41.867-1.512 4.456-7.418 21.847-20.923 7.944-7.111-7.32-3.819-14.64 9.125-16.85-7.405 1.264-15.73-.825-18.014-9.015C1.12 23.022 0 8.51 0 6.55 0-3.268 8.579-.182 13.873 3.805ZM50.127 3.805C42.79 9.332 34.897 20.537 32 26.55v15.882c0-.338.13.044.41.867 1.512 4.456 7.418 21.847 20.923 7.944 7.111-7.32 3.819-14.64-9.125-16.85 7.405 1.264 15.73-.825 18.014-9.015C62.88 23.022 64 8.51 64 6.55c0-9.818-8.578-6.732-13.873-2.745Z",
                ],
            ],
            [
                'nome' => 'LinkedIn',
                'icona' => 'it-linkedin',
                'link' => 'https://www.linkedin.com/school/scuola-normale-superiore/',
                'svg' => null,
            ],
            [
                'nome' => 'Facebook',
                'icona' => 'it-facebook',
                'link' => 'https://www.facebook.com/scuolanormale',
                'svg' => null,
            ],
            [
                'nome' => 'Youtube',
                'icona' => 'it-youtube',
                'link' => 'https://www.youtube.com/user/ScuolaNormale',
                'svg' => null,
            ],

        ];


        View::composer(['*'], function ($view) use ($headerMenuPrincipale, $headerMenuSecondario) {
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

        View::composer(['sns.includes.header','sns.includes.footer'], function ($view) use ($socialLinks) {
            $view->with('socials', $socialLinks);
        });
        View::composer(['auth.login'], function ($view) {
            $descrizione = SezioneLayout::where('codice', 'login-intro')->firstOrNew();
            $view->with('descrizione', $descrizione);
        });
        View::composer(['auth.login-scuola'], function ($view) {
            $descrizione = SezioneLayout::where('codice', 'login-scuola-intro')->firstOrNew();
            $view->with('descrizione', $descrizione);
        });
        View::composer(['auth.register-scuola'], function ($view) {
            $descrizione = SezioneLayout::where('codice', 'registrazione-scuola-intro')->firstOrNew();
            $view->with('descrizione', $descrizione);
        });
        Validator::extend('username_email', 'App\Validation\Rules@usernameEmail');

    }

    protected function calculateHeaderActive()
    {
//        if (Theme::get() != 'sns') {
//            return null;
//        }
        $uri = request()->getRequestUri();

        if (Str::startsWith($uri, ['/orientamento', '/pagina-orientamento'])) {
            return 'orientamento';
        }
        if (Str::startsWith($uri, ['/archivio-eventi', '/dettaglio-evento'])) {
            return 'eventi';
        }
        if (Str::startsWith($uri, ['/info-corsi', '/info-corso'])) {
            return 'info-corsi';
        }
        if (Str::startsWith($uri, ['/candidatura', '/candidature'])) {
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
