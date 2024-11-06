<?php

namespace App\Models\Relations;

trait AttachmentRelations
{

    public function mediable() {

        return $this->morphTo('mediable', null, null);

    }



}
