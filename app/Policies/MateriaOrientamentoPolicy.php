<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MateriaOrientamento;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class MateriaOrientamentoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MateriaOrientamento  $model
     * @return mixed
     */
    public function view(User $user, MateriaOrientamento $model)
    {
        //
        if ($user && $user->can('view materia_orientamento')) {
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
        if ($user && $user->can('create materia_orientamento')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MateriaOrientamento  $model
     * @return mixed
     */
    public function update(User $user, MateriaOrientamento $model)
    {
        //
        if ($user && $user->can('edit materia_orientamento')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MateriaOrientamento  $model
     * @return mixed
     */
    public function delete(User $user, MateriaOrientamento $model)
    {
        //
        if ($user && $user->can('delete materia_orientamento')) {
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
        if ($user && $user->can('listing materia_orientamento')) {
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

        if ($user && $user->can('view materia_orientamento')) {
            return PolicyBuilder::all($builder,MateriaOrientamento::class);
        }

        return PolicyBuilder::none($builder,MateriaOrientamento::class);

    }
}
