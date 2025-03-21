<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ScuolaRichiesta;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScuolaRichiestaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ScuolaRichiesta  $model
     * @return mixed
     */
    public function view(User $user, ScuolaRichiesta $model)
    {
        //
        if ($user && $user->can('view scuola_richiesta')) {
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
        if ($user && $user->can('create scuola_richiesta')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ScuolaRichiesta  $model
     * @return mixed
     */
    public function update(User $user, ScuolaRichiesta $model)
    {
        //
        if ($user && $user->can('edit scuola_richiesta')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ScuolaRichiesta  $model
     * @return mixed
     */
    public function delete(User $user, ScuolaRichiesta $model)
    {
        //
        if ($user && $user->can('delete scuola_richiesta')) {
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
        if ($user && $user->can('listing scuola_richiesta')) {
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

        if ($user && $user->can('view scuola_richiesta')) {
            return PolicyBuilder::all($builder,ScuolaRichiesta::class);
        }

        return PolicyBuilder::none($builder,ScuolaRichiesta::class);

    }
}
