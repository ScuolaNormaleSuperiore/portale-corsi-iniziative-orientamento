<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FaqCategoria;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaqCategoriaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FaqCategoria  $model
     * @return mixed
     */
    public function view(User $user, FaqCategoria $model)
    {
        //
        if ($user && $user->can('view faq_categoria')) {
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
        if ($user && $user->can('create faq_categoria')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FaqCategoria  $model
     * @return mixed
     */
    public function update(User $user, FaqCategoria $model)
    {
        //
        if ($user && $user->can('edit faq_categoria')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FaqCategoria  $model
     * @return mixed
     */
    public function delete(User $user, FaqCategoria $model)
    {
        //
        if ($user && $user->can('delete faq_categoria')) {
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
        if ($user && $user->can('listing faq_categoria')) {
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

        if ($user && $user->can('view faq_categoria')) {
            return PolicyBuilder::all($builder,FaqCategoria::class);
        }

        return PolicyBuilder::none($builder,FaqCategoria::class);

    }
}
