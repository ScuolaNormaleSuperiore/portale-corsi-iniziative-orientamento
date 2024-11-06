<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FiltroSelezione;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class FiltroSelezionePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FiltroSelezione  $model
     * @return mixed
     */
    public function view(User $user, FiltroSelezione $model)
    {
        //
        if ($user && $user->can('view filtro_selezione')) {
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
        if ($user && $user->can('create filtro_selezione')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FiltroSelezione  $model
     * @return mixed
     */
    public function update(User $user, FiltroSelezione $model)
    {
        //
        if ($user && $user->can('edit filtro_selezione')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FiltroSelezione  $model
     * @return mixed
     */
    public function delete(User $user, FiltroSelezione $model)
    {
        //
        if ($user && $user->can('delete filtro_selezione')) {
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
        if ($user && $user->can('listing filtro_selezione')) {
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

        if ($user && $user->can('view filtro_selezione')) {
            return PolicyBuilder::all($builder,FiltroSelezione::class);
        }

        return PolicyBuilder::none($builder,FiltroSelezione::class);

    }
}
