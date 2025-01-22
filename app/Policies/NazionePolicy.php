<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Nazione;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class NazionePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Nazione  $model
     * @return mixed
     */
    public function view(User $user, Nazione $model)
    {
        //
        if ($user && $user->can('view nazione')) {
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
        if ($user && $user->can('create nazione')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Nazione  $model
     * @return mixed
     */
    public function update(User $user, Nazione $model)
    {
        //
        if ($user && $user->can('edit nazione')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Nazione  $model
     * @return mixed
     */
    public function delete(User $user, Nazione $model)
    {
        //
        if ($user && $user->can('delete nazione')) {
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
        if ($user && $user->can('listing nazione')) {
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

        if ($user && $user->can('view nazione')) {
            return PolicyBuilder::all($builder,Nazione::class);
        }

        return PolicyBuilder::none($builder,Nazione::class);

    }
}
