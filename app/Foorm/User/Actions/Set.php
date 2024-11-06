<?php

namespace App\Foorm\User\Actions;

use Carbon\Carbon;
use Gecche\Cupparis\App\Foorm\Base\Actions\Set as BaseSet;

class Set extends BaseSet
{

    protected function setValueEmailVerifiedAt() {

        $valueToSet = $this->valueToSet;

        if (!$valueToSet) {
            $valueToSet = null;
        } else {
            try {
                Carbon::createFromFormat('Y-m-d H:i:s', $valueToSet);
            } catch (\Exception $e) {
                $valueToSet = now();
            }
        }

        $this->modelToSet->{$this->fieldToSet} = $valueToSet;
        return $this->modelToSet->save();
    }
}
