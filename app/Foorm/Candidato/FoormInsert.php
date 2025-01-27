<?php

namespace App\Foorm\Candidato;


use App\Models\Comune;
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
                $info = $user->info;
                $mapping = [
                    "spidFiscalNumber" => 'codice_fiscale',
                    "spidMobilePhone" => 'telefono',
                    "spidAddress" => 'indirizzo',
                    "spidDateOfBirth" => 'data_nascita',
                    "spidPlaceOfBirth" => 'luogo_nascita',
                    "spidGender" => 'sesso',
                ];
                foreach ($mapping as $spidField => $dbField) {
                    $spidValue = Arr::get(Arr::get($info,$spidField,[]),0);
                    if (!$spidValue) {
                        continue;
                    }

                    if ($spidField == 'spidPlaceOfBirth') {
                        $comune = Comune::where('codice_catastale',$spidValue)->first();
                        if ($comune) {
                            $spidValue = $comune->nome .' (' . $comune->sigla_provincia . ')';
                        }
                    }
                    $this->extraDefaults[$dbField] = $spidValue;

                }
            default:
                break;
        }

        return $this->extraDefaults;
    }


}
