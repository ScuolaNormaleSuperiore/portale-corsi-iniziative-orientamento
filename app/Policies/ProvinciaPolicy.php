<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Provincia;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProvinciaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Provincia  $model
     * @return mixed
     */
    public function view(User $user, Provincia $model)
    {
        //
        if ($user && $user->can('view provincia')) {
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
        if ($user && $user->can('create provincia')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Provincia  $model
     * @return mixed
     */
    public function update(User $user, Provincia $model)
    {
        //
        if ($user && $user->can('edit provincia')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Provincia  $model
     * @return mixed
     */
    public function delete(User $user, Provincia $model)
    {
        //
        if ($user && $user->can('delete provincia')) {
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
        if ($user && $user->can('listing provincia')) {
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

        if ($user && $user->can('view provincia')) {
            return PolicyBuilder::all($builder,Provincia::class);
        }

        return PolicyBuilder::none($builder,Provincia::class);

    }
}
