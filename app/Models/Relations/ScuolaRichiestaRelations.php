<?php

namespace App\Models\Relations;

trait ScuolaRichiestaRelations
{

    public function scuola() {

        return $this->belongsTo('App\Models\Scuola', 'scuola_id', null, null);
    
    }



}
