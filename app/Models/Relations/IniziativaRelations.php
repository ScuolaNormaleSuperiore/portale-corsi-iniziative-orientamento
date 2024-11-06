<?php

namespace App\Models\Relations;

trait IniziativaRelations
{

    public function filtri() {

        return $this->belongsToMany('App\Models\FiltroSelezione', 'iniziative_filtri_selezioni', null, null,
                                    null, null, null);
    
    }

    public function corsi() {

        return $this->hasMany('App\Models\Corso', 'iniziativa_id', null);
    
    }

    public function candidati() {

        return $this->hasMany('App\Models\Candidato', 'iniziativa_id', null);
    
    }

    public function fotos() {

        return $this->morphMany('App\Models\Foto', 'mediable', null, null, null);
    
    }

    public function attachments() {

        return $this->morphMany('App\Models\Attachment', 'mediable', null, null, null);
    
    }



}
