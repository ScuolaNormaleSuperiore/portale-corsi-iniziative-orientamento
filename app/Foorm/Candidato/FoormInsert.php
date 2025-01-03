<?php

namespace App\Foorm\Candidato;


use Gecche\Cupparis\App\Foorm\Base\FoormInsert as BaseFoormInsert;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class FoormInsert extends BaseFoormInsert
{
    protected $step;

    use CandidatoTrait;

    public function getExtraDefaults()
    {
        $role = auth_role_name();

        switch ($role) {
            case 'Admin':
            case 'Superutente':
            case 'Operatore':
                $this->extraDefaults['informativa'] = true;
            case 'Studente':
                $user = Auth::user();
                $this->extraDefaults['nome'] = $user->nome;
                $this->extraDefaults['cognome'] = $user->cognome;
                $this->extraDefaults['emails'] = $user->email;
            default:
                break;
        }

        return $this->extraDefaults;
    }


}
