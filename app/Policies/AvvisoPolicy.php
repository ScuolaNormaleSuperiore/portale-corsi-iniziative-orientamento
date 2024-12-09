<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Avviso;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class AvvisoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Avviso  $model
     * @return mixed
     */
    public function view(User $user, Avviso $model)
    {
        //
        if ($user && $user->can('view avviso')) {
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
        if ($user && $user->can('create avviso')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Avviso  $model
     * @return mixed
     */
    public function update(User $user, Avviso $model)
    {
        //
        if ($user && $user->can('edit avviso')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Avviso  $model
     * @return mixed
     */
    public function delete(User $user, Avviso $model)
    {
        //
        if ($user && $user->can('delete avviso')) {
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
        if ($user && $user->can('listing avviso')) {
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

        if ($user && $user->can('view avviso')) {
            return PolicyBuilder::all($builder,Avviso::class);
        }

        return PolicyBuilder::none($builder,Avviso::class);

    }
}
