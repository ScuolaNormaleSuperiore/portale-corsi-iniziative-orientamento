<?php

namespace App\Models\Relations;

trait FotoRelations
{

    public function mediable() {

        return $this->morphTo('mediable', null, null);

    }



}
