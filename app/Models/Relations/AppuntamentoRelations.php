<?php

namespace App\Models\Relations;

trait AppuntamentoRelations
{

    public function settore() {

        return $this->belongsTo('App\Models\Settore', 'settore_id', null, null);
    
    }



}
