<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comune;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComunePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comune  $model
     * @return mixed
     */
    public function view(User $user, Comune $model)
    {
        //
        if ($user && $user->can('view comune')) {
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
        if ($user && $user->can('create comune')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comune  $model
     * @return mixed
     */
    public function update(User $user, Comune $model)
    {
        //
        if ($user && $user->can('edit comune')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comune  $model
     * @return mixed
     */
    public function delete(User $user, Comune $model)
    {
        //
        if ($user && $user->can('delete comune')) {
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
        if ($user && $user->can('listing comune')) {
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

        if ($user && $user->can('view comune')) {
            return PolicyBuilder::all($builder,Comune::class);
        }

        return PolicyBuilder::none($builder,Comune::class);

    }
}
