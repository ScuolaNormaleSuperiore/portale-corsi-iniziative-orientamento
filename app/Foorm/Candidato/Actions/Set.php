<?php

namespace App\Foorm\Candidato\Actions;

use App\Enums\CandidatoStatuses;
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

        if ($this->valueToSet == CandidatoStatuses::APPROVATA->value) {
            // check posti
            if (!$modelToSet->checkPosto()) {
                if ($modelToSet->tipo == 'scuola') {
                    throw new \Exception("Numero di posti ( ". $modelToSet->iniziativa->posti .") disponibili per le scuole raggiunto.");
                } else {
                    throw new \Exception("Numero di posti ( ". $modelToSet->iniziativa->posti_onere .") disponibili per le candidature singole raggiunto.");
                }
            }
        }

        $this->modelToSet->makeTransitionAndSave($this->valueToSet);
        return true;
    }
}
