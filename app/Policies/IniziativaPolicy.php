<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Iniziativa;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class IniziativaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Iniziativa  $model
     * @return mixed
     */
    public function view(User $user, Iniziativa $model)
    {
        //
        if ($user && $user->can('view iniziativa')) {
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
        if ($user && $user->can('create iniziativa')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Iniziativa  $model
     * @return mixed
     */
    public function update(User $user, Iniziativa $model)
    {
        //
        if ($user && $user->can('edit iniziativa')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Iniziativa  $model
     * @return mixed
     */
    public function delete(User $user, Iniziativa $model)
    {
        //
        if ($user && $user->can('delete iniziativa')) {
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
        if ($user && $user->can('listing iniziativa')) {
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

        if ($user && $user->can('view iniziativa')) {
            return PolicyBuilder::all($builder,Iniziativa::class);
        }

        return PolicyBuilder::none($builder,Iniziativa::class);

    }
}
