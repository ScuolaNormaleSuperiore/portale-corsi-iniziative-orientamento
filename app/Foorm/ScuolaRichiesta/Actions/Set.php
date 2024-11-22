<?php

namespace App\Foorm\ScuolaRichiesta\Actions;

use App\Models\Scuola;
use App\Models\User;
use Carbon\Carbon;
use Gecche\Cupparis\App\Foorm\Base\Actions\Set as BaseSet;
use Illuminate\Auth\Events\Registered;

class Set extends BaseSet
{

    protected function setValueApprovata() {

        $valueToSet = $this->valueToSet;

        $modelToSet = $this->modelToSet;

        if (!$valueToSet) {
            return true;
        }

        $scuola = Scuola::find($modelToSet->scuola_id);

        if ($scuola->user_id) {
            throw new \Exception("L'istituto ha già un referente assegnato");
        }

        $scuolaConStessaEmail = Scuola::where('email_riferimento',$modelToSet->email)
            ->first();
        if ($scuolaConStessaEmail && $scuolaConStessaEmail->getKey()) {
            throw new \Exception("Questa email è già utilizzata da un altro istituto");
        }

        $userConStessaEmail = User::where('email',$modelToSet->email)
            ->first();
        if ($userConStessaEmail && $userConStessaEmail->getKey()) {
            throw new \Exception("Questa email è già utilizzata da un altro utente del portale");
        }

        $modelToSet->{$this->fieldToSet} = $valueToSet;


        $scuola->email_riferimento = $modelToSet->email;

        $user = User::create([
            'name' => $scuola->email_riferimento,
            'email' => $scuola->email_riferimento,
            'password' => $modelToSet->password,
        ]);

        event(new Registered($user));
        $user->assignRole('Scuola');
        $user->save();

        $scuola->user_id = $user->getKey();
        $scuola->save();

        return $modelToSet->save();
    }
}
