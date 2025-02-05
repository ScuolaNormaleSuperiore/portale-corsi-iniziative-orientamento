<?php

namespace App\Models\Relations;

use App\Models\Candidato;
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

        $user = Auth::user();


        if (!$user) {
            return $this->hasMany('App\Models\Candidato', 'iniziativa_id', null)
                ->where('user_id',-1);
        }

        $candidatureIds = Candidato::acl()->get()->pluck('id','id')->all();
        if (count($candidatureIds) <= 0) {
            $candidatureIds = [-1 => -1];
        }
        return $this->hasMany('App\Models\Candidato', 'iniziativa_id', null)
            ->whereIn('id',$candidatureIds);



    }




}
