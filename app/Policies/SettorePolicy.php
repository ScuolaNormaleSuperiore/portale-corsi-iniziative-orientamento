<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Settore;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettorePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Settore  $model
     * @return mixed
     */
    public function view(User $user, Settore $model)
    {
        //
        if ($user && $user->can('view settore')) {
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
        if ($user && $user->can('create settore')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Settore  $model
     * @return mixed
     */
    public function update(User $user, Settore $model)
    {
        //
        if ($user && $user->can('edit settore')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Settore  $model
     * @return mixed
     */
    public function delete(User $user, Settore $model)
    {
        //
        if ($user && $user->can('delete settore')) {
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
        if ($user && $user->can('listing settore')) {
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

        if ($user && $user->can('view settore')) {
            return PolicyBuilder::all($builder,Settore::class);
        }

        return PolicyBuilder::none($builder,Settore::class);

    }
}
