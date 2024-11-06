<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StudenteOrientamento;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudenteOrientamentoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StudenteOrientamento  $model
     * @return mixed
     */
    public function view(User $user, StudenteOrientamento $model)
    {
        //
        if ($user && $user->can('view studente_orientamento')) {
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
        if ($user && $user->can('create studente_orientamento')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StudenteOrientamento  $model
     * @return mixed
     */
    public function update(User $user, StudenteOrientamento $model)
    {
        //
        if ($user && $user->can('edit studente_orientamento')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StudenteOrientamento  $model
     * @return mixed
     */
    public function delete(User $user, StudenteOrientamento $model)
    {
        //
        if ($user && $user->can('delete studente_orientamento')) {
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
        if ($user && $user->can('listing studente_orientamento')) {
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

        if ($user && $user->can('view studente_orientamento')) {
            return PolicyBuilder::all($builder,StudenteOrientamento::class);
        }

        return PolicyBuilder::none($builder,StudenteOrientamento::class);

    }
}
