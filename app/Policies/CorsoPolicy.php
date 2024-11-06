<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Corso;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class CorsoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Corso  $model
     * @return mixed
     */
    public function view(User $user, Corso $model)
    {
        //
        if ($user && $user->can('view corso')) {
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
        if ($user && $user->can('create corso')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Corso  $model
     * @return mixed
     */
    public function update(User $user, Corso $model)
    {
        //
        if ($user && $user->can('edit corso')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Corso  $model
     * @return mixed
     */
    public function delete(User $user, Corso $model)
    {
        //
        if ($user && $user->can('delete corso')) {
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
        if ($user && $user->can('listing corso')) {
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

        if ($user && $user->can('view corso')) {
            return PolicyBuilder::all($builder,Corso::class);
        }

        return PolicyBuilder::none($builder,Corso::class);

    }
}
