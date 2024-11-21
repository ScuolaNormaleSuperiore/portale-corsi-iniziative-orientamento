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

        $modelToSet->{$this->fieldToSet} = $valueToSet;

        $scuola = Scuola::find($modelToSet->scuola_id);

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
