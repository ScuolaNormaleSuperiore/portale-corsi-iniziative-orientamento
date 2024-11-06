<?php

namespace App\Models\Relations;

trait NewsRelations
{

    public function fotos() {

        return $this->morphMany('App\Models\Foto', 'mediable', null, null, null);
    
    }

    public function attachments() {

        return $this->morphMany('App\Models\Attachment', 'mediable', null, null, null);
    
    }

    public function sezioni() {

        return $this->morphMany('App\Models\SezioneContenuto', 'sezionable', null, null, null);
    
    }



}
