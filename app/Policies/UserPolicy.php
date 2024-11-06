<?php

namespace App\Policies;

use App\Models\User;
use App\Services\PermissionsHelper;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        //
        return $this->_aclCheck($user,$model);

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
        if ($user && $user->can('create user')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        //
        return $this->_aclCheck($user,$model);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //
        return $this->_aclCheck($user,$model);
    }


//    public function abilita(User $user, User $model) {
//        return $this->update($user, $model);
//
//    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function listing(User $user)
    {
        //
        if ($user && $user->can('list user')) {
            return true;
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function acl(User $user, $builder)
    {
        if (!$user || !$user->mainrole) {
            return PolicyBuilder::none($builder,User::class);
        }
        switch ($user->mainrole->name) {
            case 'Admin':
                $usersIds = PermissionsHelper::getUsersIdsbyRoles(['Operatore']);
                return $builder->whereIn('id',$usersIds + [$user->getKey()]);
            default:
                return PolicyBuilder::none($builder,User::class);
        }
    }


    protected function _aclCheck(User $user, User $model) {
        if (!$user || !$user->mainrole) {
            return false;
        }
        switch ($user->mainrole->name) {
            case 'Admin':
                $usersIds = PermissionsHelper::getUsersIdsbyRoles(['Operatore']) + [$user->getKey()];
                return in_array($model->getKey(),$usersIds);
            default:
                return false;
        }
    }
}
