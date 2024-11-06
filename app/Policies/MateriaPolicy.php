<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Materia;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class MateriaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Materia  $model
     * @return mixed
     */
    public function view(User $user, Materia $model)
    {
        //
        if ($user && $user->can('view materia')) {
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
        if ($user && $user->can('create materia')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Materia  $model
     * @return mixed
     */
    public function update(User $user, Materia $model)
    {
        //
        if ($user && $user->can('edit materia')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Materia  $model
     * @return mixed
     */
    public function delete(User $user, Materia $model)
    {
        //
        if ($user && $user->can('delete materia')) {
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
        if ($user && $user->can('listing materia')) {
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

        if ($user && $user->can('view materia')) {
            return PolicyBuilder::all($builder,Materia::class);
        }

        return PolicyBuilder::none($builder,Materia::class);

    }
}
