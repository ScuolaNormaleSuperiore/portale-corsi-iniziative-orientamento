<?php

namespace App\Models\Relations;

trait VideoRelations
{

    public function categoria() {

        return $this->belongsTo('App\Models\CategoriaVideo', 'categoria_id', null, null);
    
    }



}
