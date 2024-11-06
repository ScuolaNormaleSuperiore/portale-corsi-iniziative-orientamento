<?php

namespace App\Models\Relations;

trait ProvinciaRelations
{

    public function regione() {

        return $this->belongsTo('App\Models\Regione', 'regione_id', null, null);
    
    }



}
