<?php

namespace App\Providers;

use App\Models\Pagina;
use App\Models\PaginaOrientamento;
use Gecche\Cupparis\App\Foorm\FoormManager;
use Gecche\Cupparis\Menus\Facades\Menus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer(['*'], function ($view) {
            $authRole = Auth::id() ? Auth::user()->mainrole : null;
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
