<?php

namespace App\Models\Relations;

trait UserRelations
{

    public function scuola() {

        return $this->hasOne('App\Models\Scuola', 'user_id', null);

    }

    public function fotos() {

        return $this->morphMany('App\Models\Foto', 'mediable', null, null, null);

    }

    public function attachments() {

        return $this->morphMany('App\Models\Attachment', 'mediable', null, null, null);

    }




}
