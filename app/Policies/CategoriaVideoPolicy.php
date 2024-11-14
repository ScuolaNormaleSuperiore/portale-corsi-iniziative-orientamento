<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CategoriaVideo;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoriaVideoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoriaVideo  $model
     * @return mixed
     */
    public function view(User $user, CategoriaVideo $model)
    {
        //
        if ($user && $user->can('view categoria_video')) {
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
        if ($user && $user->can('create categoria_video')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoriaVideo  $model
     * @return mixed
     */
    public function update(User $user, CategoriaVideo $model)
    {
        //
        if ($user && $user->can('edit categoria_video')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoriaVideo  $model
     * @return mixed
     */
    public function delete(User $user, CategoriaVideo $model)
    {
        //
        if ($user && $user->can('delete categoria_video')) {
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
        if ($user && $user->can('listing categoria_video')) {
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

        if ($user && $user->can('view categoria_video')) {
            return PolicyBuilder::all($builder,CategoriaVideo::class);
        }

        return PolicyBuilder::none($builder,CategoriaVideo::class);

    }
}
