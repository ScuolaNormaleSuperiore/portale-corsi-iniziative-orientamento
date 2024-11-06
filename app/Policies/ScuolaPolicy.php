<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Scuola;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScuolaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Scuola  $model
     * @return mixed
     */
    public function view(User $user, Scuola $model)
    {
        //
        if ($user && $user->can('view scuola')) {
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
        if ($user && $user->can('create scuola')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Scuola  $model
     * @return mixed
     */
    public function update(User $user, Scuola $model)
    {
        //
        if ($user && $user->can('edit scuola')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Scuola  $model
     * @return mixed
     */
    public function delete(User $user, Scuola $model)
    {
        //
        if ($user && $user->can('delete scuola')) {
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
        if ($user && $user->can('listing scuola')) {
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

        if ($user && $user->can('view scuola')) {
            return PolicyBuilder::all($builder,Scuola::class);
        }

        return PolicyBuilder::none($builder,Scuola::class);

    }
}
