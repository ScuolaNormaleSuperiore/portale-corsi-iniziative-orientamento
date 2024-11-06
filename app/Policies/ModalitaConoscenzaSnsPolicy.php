<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ModalitaConoscenzaSns;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModalitaConoscenzaSnsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ModalitaConoscenzaSns  $model
     * @return mixed
     */
    public function view(User $user, ModalitaConoscenzaSns $model)
    {
        //
        if ($user && $user->can('view modalita_conoscenza_sns')) {
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
        if ($user && $user->can('create modalita_conoscenza_sns')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ModalitaConoscenzaSns  $model
     * @return mixed
     */
    public function update(User $user, ModalitaConoscenzaSns $model)
    {
        //
        if ($user && $user->can('edit modalita_conoscenza_sns')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ModalitaConoscenzaSns  $model
     * @return mixed
     */
    public function delete(User $user, ModalitaConoscenzaSns $model)
    {
        //
        if ($user && $user->can('delete modalita_conoscenza_sns')) {
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
        if ($user && $user->can('listing modalita_conoscenza_sns')) {
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

        if ($user && $user->can('view modalita_conoscenza_sns')) {
            return PolicyBuilder::all($builder,ModalitaConoscenzaSns::class);
        }

        return PolicyBuilder::none($builder,ModalitaConoscenzaSns::class);

    }
}
