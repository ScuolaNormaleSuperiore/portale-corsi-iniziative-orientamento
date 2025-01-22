<?php

namespace App\Models\Relations;

trait ComuneRelations
{

    public function provincia() {

        return $this->belongsTo('App\Models\Provincia', 'provincia_id', null, null);
    
    }

    public function regione() {

        return $this->belongsTo('App\Models\Regione', 'regione_id', null, null);
    
    }

    public function nazione() {

        return $this->belongsTo('App\Models\Nazione', 'nazione_id', null, null);
    
    }



}
