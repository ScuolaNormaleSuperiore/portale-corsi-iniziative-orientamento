<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TitoloStudio;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class TitoloStudioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TitoloStudio  $model
     * @return mixed
     */
    public function view(User $user, TitoloStudio $model)
    {
        //
        if ($user && $user->can('view titolo_studio')) {
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
        if ($user && $user->can('create titolo_studio')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TitoloStudio  $model
     * @return mixed
     */
    public function update(User $user, TitoloStudio $model)
    {
        //
        if ($user && $user->can('edit titolo_studio')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TitoloStudio  $model
     * @return mixed
     */
    public function delete(User $user, TitoloStudio $model)
    {
        //
        if ($user && $user->can('delete titolo_studio')) {
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
        if ($user && $user->can('listing titolo_studio')) {
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

        if ($user && $user->can('view titolo_studio')) {
            return PolicyBuilder::all($builder,TitoloStudio::class);
        }

        return PolicyBuilder::none($builder,TitoloStudio::class);

    }
}
