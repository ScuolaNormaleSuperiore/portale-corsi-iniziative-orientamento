<?php

namespace App\Foorm\Candidato\Actions;

use App\Models\Scuola;
use App\Models\User;
use Carbon\Carbon;
use Gecche\Cupparis\App\Foorm\Base\Actions\Set as BaseSet;
use Illuminate\Auth\Events\Registered;

class Set extends BaseSet
{

    protected function setValueStatus() {

        $valueToSet = $this->valueToSet;

        $modelToSet = $this->modelToSet;

        if (!$valueToSet) {
            return true;
        }
        $this->modelToSet->makeTransitionAndSave($this->valueToSet);
        return true;
    }
}
