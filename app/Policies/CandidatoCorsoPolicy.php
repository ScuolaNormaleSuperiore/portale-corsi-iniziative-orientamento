<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CandidatoCorso;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidatoCorsoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CandidatoCorso  $model
     * @return mixed
     */
    public function view(User $user, CandidatoCorso $model)
    {
        //
        if ($user && $user->can('view candidato_corso')) {
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
        if ($user && $user->can('create candidato_corso')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CandidatoCorso  $model
     * @return mixed
     */
    public function update(User $user, CandidatoCorso $model)
    {
        //
        if ($user && $user->can('edit candidato_corso')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CandidatoCorso  $model
     * @return mixed
     */
    public function delete(User $user, CandidatoCorso $model)
    {
        //
        if ($user && $user->can('delete candidato_corso')) {
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
        if ($user && $user->can('listing candidato_corso')) {
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

        if ($user && $user->can('view candidato_corso')) {
            return PolicyBuilder::all($builder,CandidatoCorso::class);
        }

        return PolicyBuilder::none($builder,CandidatoCorso::class);

    }
}
