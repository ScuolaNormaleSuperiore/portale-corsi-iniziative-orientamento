<?php

namespace App\Models\Relations;

trait CandidatoVotiRelations
{

    public function candidato() {

        return $this->belongsTo('App\Models\Candidato', 'candidato_id', null, null);
    
    }

    public function materia() {

        return $this->belongsTo('App\Models\Materia', 'materia_id', null, null);
    
    }



}
