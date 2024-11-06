<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CandidatoVoti;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidatoVotiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CandidatoVoti  $model
     * @return mixed
     */
    public function view(User $user, CandidatoVoti $model)
    {
        //
        if ($user && $user->can('view candidato_voti')) {
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
        if ($user && $user->can('create candidato_voti')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CandidatoVoti  $model
     * @return mixed
     */
    public function update(User $user, CandidatoVoti $model)
    {
        //
        if ($user && $user->can('edit candidato_voti')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CandidatoVoti  $model
     * @return mixed
     */
    public function delete(User $user, CandidatoVoti $model)
    {
        //
        if ($user && $user->can('delete candidato_voti')) {
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
        if ($user && $user->can('listing candidato_voti')) {
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

        if ($user && $user->can('view candidato_voti')) {
            return PolicyBuilder::all($builder,CandidatoVoti::class);
        }

        return PolicyBuilder::none($builder,CandidatoVoti::class);

    }
}
