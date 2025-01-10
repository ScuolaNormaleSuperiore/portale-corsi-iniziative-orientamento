<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PaginaInfo;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaginaInfoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaginaInfo  $model
     * @return mixed
     */
    public function view(User $user, PaginaInfo $model)
    {
        //
        if ($user && $user->can('view pagina_info')) {
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
        if ($user && $user->can('create pagina_info')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaginaInfo  $model
     * @return mixed
     */
    public function update(User $user, PaginaInfo $model)
    {
        //
        if ($user && $user->can('edit pagina_info')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaginaInfo  $model
     * @return mixed
     */
    public function delete(User $user, PaginaInfo $model)
    {
        //
        if ($user && $user->can('delete pagina_info')) {
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
        if ($user && $user->can('listing pagina_info')) {
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

        if ($user && $user->can('view pagina_info')) {
            return PolicyBuilder::all($builder,PaginaInfo::class);
        }

        return PolicyBuilder::none($builder,PaginaInfo::class);

    }
}
