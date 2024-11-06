<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Appuntamento;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppuntamentoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Appuntamento  $model
     * @return mixed
     */
    public function view(User $user, Appuntamento $model)
    {
        //
        if ($user && $user->can('view appuntamento')) {
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
        if ($user && $user->can('create appuntamento')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Appuntamento  $model
     * @return mixed
     */
    public function update(User $user, Appuntamento $model)
    {
        //
        if ($user && $user->can('edit appuntamento')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Appuntamento  $model
     * @return mixed
     */
    public function delete(User $user, Appuntamento $model)
    {
        //
        if ($user && $user->can('delete appuntamento')) {
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
        if ($user && $user->can('listing appuntamento')) {
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

        if ($user && $user->can('view appuntamento')) {
            return PolicyBuilder::all($builder,Appuntamento::class);
        }

        return PolicyBuilder::none($builder,Appuntamento::class);

    }
}
