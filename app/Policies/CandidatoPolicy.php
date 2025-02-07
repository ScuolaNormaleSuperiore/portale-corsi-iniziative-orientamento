<?php

namespace App\Policies;

use App\Enums\CandidatoStatuses;
use App\Models\User;
use App\Models\Candidato;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Arr;

class CandidatoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Candidato $model
     * @return mixed
     */
    public function view(User $user, Candidato $model)
    {
        //
        return $this->_aclCheck($user, $model, 'view');

    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        if ($user && $user->can('create candidato')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Candidato $model
     * @return mixed
     */
    public function update(User $user, Candidato $model)
    {
        //
        return $this->_aclCheck($user, $model, 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Candidato $model
     * @return mixed
     */
    public function delete(User $user, Candidato $model)
    {
        //
        return $this->_aclCheck($user, $model, 'edit');
    }


//    public function abilita(User $user, User $model) {
//        return $this->update($user, $model);
//
//    }

    /**
     * Determine whether the user can access to the listing of the models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function listing(User $user)
    {
        //
        if ($user && $user->can('listing candidato')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can access to the listing of the models.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Candidato $model
     * @return mixed
     */
    public function acl(User $user, $builder)
    {
        if (!$user || !$user->mainrole) {
            return PolicyBuilder::none($builder, User::class);
        }
        switch ($user->mainrole->name) {
            case 'Admin':
            case 'Operatore':
                return PolicyBuilder::all($builder, Candidato::class);
            case 'Scuola':
                $scuola = $user->scuola;
                if (!$scuola || !$scuola->getKey()) {
                    return PolicyBuilder::none($builder, User::class);
                }
                return
                    $builder->where(function ($q) use ($scuola,$user) {
                       $q->where(function ($q2) use ($scuola) {
                            $q2->where('tipo', 'scuola')
                            ->where('scuola_id', $scuola->getKey());
                       })->orWhere(function ($q2) use ($user) {
                           $q2->where('tipo', 'scuola')
                               ->whereNull('scuola_id')
                           ->where('user_id', $user->getKey());
                       });
                    });
//                return $builder->where('user_id', $user->getKey());
            case 'Studente':
                return $builder->where(function ($q) use ($user) {
                    return $q->where('user_id', $user->getKey())
                        ->orWhere(function ($q2) use ($user) {
                            return $q2->where('codice_fiscale',$user->codice_fiscale)
                                ->whereNotNull('codice_fiscale');
//                                ->whereNotIn('status',[CandidatoStatuses::BOZZA->value]);
                        });
                });



            default:
                return PolicyBuilder::none($builder, User::class);
        }
    }


    protected function _aclCheck(User $user, Candidato $model, $type)
    {
        if (!$user || !$user->mainrole) {
            return false;
        }
        switch ($type) {
            case 'view':
                switch ($user->mainrole->name) {
                    case 'Admin':
                    case 'Operatore':
                        return true;
                    case 'Scuola':
                        $scuola = $user->scuola;
                        if (!$scuola || !$scuola->getKey()) {
                            return false;
                        }
                        if (($model->tipo == 'scuola') && ($model->scuola_id == $scuola->getKey())) {
                            return true;
                        };
                        if (($model->tipo == 'scuola') && is_null($model->scuola_id) && $model->user_id = $user->getKey()) {
                            return true;
                        }
                        return false;
//                        return $model->user_id == $user->getKey();
                    case 'Studente':
                        if ($model->user_id == $user->getKey()) {
                            return true;
                        }
                        return (
                            ($model->codice_fiscale && $model->codice_fiscale == $user->codice_fiscale)
                        );
                    default:
                        return false;
                }
            case 'edit':
                switch ($user->mainrole->name) {
                    case 'Admin':
                    case 'Operatore':
                        return true;
                    case 'Scuola':
                        $scuola = $user->scuola;
                        if (!$scuola || !$scuola->getKey()) {
                            return false;
                        }
                        if (($model->tipo == 'scuola') && ($model->scuola_id == $scuola->getKey())) {
                            return true;
                        };
                        if (($model->tipo == 'scuola') && is_null($model->scuola_id) && $model->user_id = $user->getKey()) {
                            return true;
                        }
                    case 'Studente':
                        return $model->user_id == $user->getKey();
                    default:
                        return false;
                }
            default:
                return false;
        }
    }
}
