<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SezioneLayout;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class SezioneLayoutPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SezioneLayout  $model
     * @return mixed
     */
    public function view(User $user, SezioneLayout $model)
    {
        //
        if ($user && $user->can('view sezione_layout')) {
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
        if ($user && $user->can('create sezione_layout')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SezioneLayout  $model
     * @return mixed
     */
    public function update(User $user, SezioneLayout $model)
    {
        //
        if ($user && $user->can('edit sezione_layout')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SezioneLayout  $model
     * @return mixed
     */
    public function delete(User $user, SezioneLayout $model)
    {
        //
        if ($user && $user->can('delete sezione_layout')) {
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
        if ($user && $user->can('listing sezione_layout')) {
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

        if ($user && $user->can('view sezione_layout')) {
            return PolicyBuilder::all($builder,SezioneLayout::class);
        }

        return PolicyBuilder::none($builder,SezioneLayout::class);

    }
}
