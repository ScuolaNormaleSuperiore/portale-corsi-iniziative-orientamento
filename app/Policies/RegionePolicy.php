<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Regione;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegionePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Regione  $model
     * @return mixed
     */
    public function view(User $user, Regione $model)
    {
        //
        if ($user && $user->can('view regione')) {
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
        if ($user && $user->can('create regione')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Regione  $model
     * @return mixed
     */
    public function update(User $user, Regione $model)
    {
        //
        if ($user && $user->can('edit regione')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Regione  $model
     * @return mixed
     */
    public function delete(User $user, Regione $model)
    {
        //
        if ($user && $user->can('delete regione')) {
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
        if ($user && $user->can('listing regione')) {
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

        if ($user && $user->can('view regione')) {
            return PolicyBuilder::all($builder,Regione::class);
        }

        return PolicyBuilder::none($builder,Regione::class);

    }
}
