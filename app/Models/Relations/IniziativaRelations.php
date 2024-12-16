<?php

namespace App\Models\Relations;

use Illuminate\Support\Facades\Auth;

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
    public function authcandidature() {

        return $this->hasMany('App\Models\Candidato', 'iniziativa_id', null)
            ->where('user_id',Auth::id() ?: -1);

    }




}
