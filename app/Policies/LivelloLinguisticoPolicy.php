<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LivelloLinguistico;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class LivelloLinguisticoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LivelloLinguistico  $model
     * @return mixed
     */
    public function view(User $user, LivelloLinguistico $model)
    {
        //
        if ($user && $user->can('view livello_linguistico')) {
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
        if ($user && $user->can('create livello_linguistico')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LivelloLinguistico  $model
     * @return mixed
     */
    public function update(User $user, LivelloLinguistico $model)
    {
        //
        if ($user && $user->can('edit livello_linguistico')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LivelloLinguistico  $model
     * @return mixed
     */
    public function delete(User $user, LivelloLinguistico $model)
    {
        //
        if ($user && $user->can('delete livello_linguistico')) {
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
        if ($user && $user->can('listing livello_linguistico')) {
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

        if ($user && $user->can('view livello_linguistico')) {
            return PolicyBuilder::all($builder,LivelloLinguistico::class);
        }

        return PolicyBuilder::none($builder,LivelloLinguistico::class);

    }
}
