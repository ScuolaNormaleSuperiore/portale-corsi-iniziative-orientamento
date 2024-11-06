<?php

namespace App\Models\Relations;

trait FiltroSelezioneRelations
{

    public function iniziative() {

        return $this->belongsToMany('App\Models\Iniziativa', 'iniziative_filtri_selezioni', null, null,
                                    null, null, null);
    
    }



}
