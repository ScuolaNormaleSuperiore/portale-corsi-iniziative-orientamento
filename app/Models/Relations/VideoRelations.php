<?php

namespace App\Models\Relations;

use App\Models\MateriaOrientamento;

trait VideoRelations
{

    public function categoria() {

        return $this->belongsTo(MateriaOrientamento::class, 'materia_id', null, null);

    }



}
