<?php

namespace App\Models\Relations;

trait MateriaOrientamentoRelations
{

    public function classe() {

        return $this->belongsTo('App\Models\Classe', 'classe_id', null, null);
    
    }

    public function studenti() {

        return $this->hasMany('App\Models\StudenteOrientamento', 'materia_id', null);
    
    }



}
