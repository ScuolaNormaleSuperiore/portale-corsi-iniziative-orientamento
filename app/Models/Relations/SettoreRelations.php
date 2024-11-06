<?php

namespace App\Models\Relations;

trait SettoreRelations
{

    public function appuntamento() {

        return $this->hasMany('App\Models\Settore', 'appuntamento_id', null);
    
    }



}
