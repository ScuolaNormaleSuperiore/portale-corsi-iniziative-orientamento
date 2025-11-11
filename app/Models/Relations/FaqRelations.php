<?php

namespace App\Models\Relations;

trait FaqRelations
{

    public function categoria() {

        return $this->belongsTo('App\Models\FaqCategoria', 'categoria_id', null, null);
    
    }



}
