<?php

namespace App\Models\Relations;

trait ScuolaRelations
{

    public function regione() {

        return $this->belongsTo('App\Models\Regione', 'regione_id', null, null);
    
    }

    public function provincia() {

        return $this->belongsTo('App\Models\Provincia', 'provincia_id', null, null);
    
    }

    public function user() {

        return $this->belongsTo('App\Models\User', 'user_id', null, null);
    
    }

    public function comunesns() {

        return $this->belongsTo('App\Models\Comune', 'comune_id', null, null);
    
    }



}
