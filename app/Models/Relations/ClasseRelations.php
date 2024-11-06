<?php

namespace App\Models\Relations;

trait ClasseRelations
{

    public function materie() {

        return $this->hasMany('App\Models\Classe', 'classe_id', null);
    
    }



}
