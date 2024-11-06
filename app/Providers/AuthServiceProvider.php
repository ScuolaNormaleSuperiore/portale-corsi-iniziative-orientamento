<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Gecche\Cupparis\App\Facades\Cupparis;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Implicitly grant "Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Superutente') ? true : null;
        });

        PolicyBuilder::beforeAcl(function ($user, $modelClassName, $context, $builder) {

            if (!$user) {
                return;
            }

            //$modelsAllowed = [Comune::class,Area::class,Regione::class,Provincia::class];
            $modelsAllowed = [];
            if ($user->hasRole('Superutente') || in_array($modelClassName,$modelsAllowed)) {
                return PolicyBuilder::all($builder,$modelClassName);
            }

            return;
        });
    }

    /**
     * Get the policies defined on the provider.
     *
     * @return array
     */
    public function policies()
    {
        $policies = Cupparis::get('policies.models',null);

        return is_array($policies) ? $policies : $this->policies;

    }
}
