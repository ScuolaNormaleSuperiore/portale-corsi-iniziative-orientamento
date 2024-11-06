<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Classe;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Classe  $model
     * @return mixed
     */
    public function view(User $user, Classe $model)
    {
        //
        if ($user && $user->can('view classe')) {
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
        if ($user && $user->can('create classe')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Classe  $model
     * @return mixed
     */
    public function update(User $user, Classe $model)
    {
        //
        if ($user && $user->can('edit classe')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Classe  $model
     * @return mixed
     */
    public function delete(User $user, Classe $model)
    {
        //
        if ($user && $user->can('delete classe')) {
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
        if ($user && $user->can('listing classe')) {
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

        if ($user && $user->can('view classe')) {
            return PolicyBuilder::all($builder,Classe::class);
        }

        return PolicyBuilder::none($builder,Classe::class);

    }
}
