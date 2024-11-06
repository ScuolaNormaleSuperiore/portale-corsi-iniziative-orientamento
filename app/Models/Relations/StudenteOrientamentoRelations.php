<?php

namespace App\Models\Relations;

trait StudenteOrientamentoRelations
{

    public function materia() {

        return $this->belongsTo('App\Models\MateriaOrientamento', 'materia_id', null, null);
    
    }

    public function fotos() {

        return $this->morphMany('App\Models\Foto', 'mediable', null, null, null);
    
    }



}
