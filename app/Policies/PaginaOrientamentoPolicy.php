<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PaginaOrientamento;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaginaOrientamentoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaginaOrientamento  $model
     * @return mixed
     */
    public function view(User $user, PaginaOrientamento $model)
    {
        //
        if ($user && $user->can('view pagina_orientamento')) {
            return true;
        }

        return false;

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        if ($user && $user->can('create pagina_orientamento')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaginaOrientamento  $model
     * @return mixed
     */
    public function update(User $user, PaginaOrientamento $model)
    {
        //
        if ($user && $user->can('edit pagina_orientamento')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaginaOrientamento  $model
     * @return mixed
     */
    public function delete(User $user, PaginaOrientamento $model)
    {
        //
        if ($user && $user->can('delete pagina_orientamento')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can access to the listing of the models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function listing(User $user)
    {
        //
        if ($user && $user->can('listing pagina_orientamento')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can access to the listing of the models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function acl(User $user, $builder)
    {

        if ($user && $user->can('view pagina_orientamento')) {
            return PolicyBuilder::all($builder,PaginaOrientamento::class);
        }

        return PolicyBuilder::none($builder,PaginaOrientamento::class);

    }
}
