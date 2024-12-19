<?php

namespace App\Models\Relations;

trait CopertinaRelations
{

    public function fotos() {

        return $this->morphMany('App\Models\Foto', 'mediable', null, null, null);
    
    }



}
