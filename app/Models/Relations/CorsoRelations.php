<?php

namespace App\Models\Relations;

trait CorsoRelations
{

    public function provincia() {

        return $this->belongsTo('App\Models\Provincia', 'provincia_id', null, null);
    
    }

    public function iniziativa() {

        return $this->belongsTo('App\Models\Iniziativa', 'iniziativa_id', null, null);
    
    }

    public function candidati() {

        return $this->belongsToMany('App\Models\Candidato', 'candidati_corsi', 'corso_id', 'candidato_id',
                                    null, null, null)
							->withPivot(['ordine']);
    
    }


    public function fotos() {

        return $this->morphMany('App\Models\Foto', 'mediable', null, null, null);

    }

    public function attachments() {

        return $this->morphMany('App\Models\Attachment', 'mediable', null, null, null);

    }

}
