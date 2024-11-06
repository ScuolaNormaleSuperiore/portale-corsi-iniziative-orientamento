<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Candidato;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidatoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Candidato  $model
     * @return mixed
     */
    public function view(User $user, Candidato $model)
    {
        //
        if ($user && $user->can('view candidato')) {
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
        if ($user && $user->can('create candidato')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Candidato  $model
     * @return mixed
     */
    public function update(User $user, Candidato $model)
    {
        //
        if ($user && $user->can('edit candidato')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Candidato  $model
     * @return mixed
     */
    public function delete(User $user, Candidato $model)
    {
        //
        if ($user && $user->can('delete candidato')) {
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
        if ($user && $user->can('listing candidato')) {
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

        if ($user && $user->can('view candidato')) {
            return PolicyBuilder::all($builder,Candidato::class);
        }

        return PolicyBuilder::none($builder,Candidato::class);

    }
}
