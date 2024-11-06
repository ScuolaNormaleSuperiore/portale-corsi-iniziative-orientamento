<?php

namespace App\Models\Relations;

trait CandidatoRelations
{

    public function iniziativa() {

        return $this->belongsTo('App\Models\Iniziativa', 'iniziativa_id', null, null);
    
    }

    public function scuola() {

        return $this->belongsTo('App\Models\Scuola', 'scuola_id', null, null);
    
    }

    public function user() {

        return $this->belongsTo('App\Models\User', 'user_id', null, null);
    
    }

    public function provincia() {

        return $this->belongsTo('App\Models\Provincia', 'provincia_id', null, null);
    
    }

    public function regione() {

        return $this->belongsTo('App\Models\Provincia', 'provincia_id', null, null);
    
    }

    public function modalita() {

        return $this->belongsTo('App\Models\ModalitaConoscenzaSns', 'modalita_conoscenza_sns_id', null, null);
    
    }

    public function titolo1() {

        return $this->belongsTo('App\Models\TitoloStudio', 'gen1_titolo_studio_id', null, null);
    
    }

    public function titolo2() {

        return $this->belongsTo('App\Models\TitoloStudio', 'gen2_titolo_studio_id', null, null);
    
    }

    public function professione1() {

        return $this->belongsTo('App\Models\Professione', 'gen1_professione_id', null, null);
    
    }

    public function professione2() {

        return $this->belongsTo('App\Models\Professione', 'gen2_professione_id', null, null);
    
    }

    public function inglese() {

        return $this->belongsTo('App\Models\LivelloLinguistico', 'inglese_livello_linguistico_id', null, null);
    
    }

    public function francese() {

        return $this->belongsTo('App\Models\LivelloLinguistico', 'francese_livello_linguistico_id', null, null);
    
    }

    public function spagnolo() {

        return $this->belongsTo('App\Models\LivelloLinguistico', 'spagnolo_livello_linguistico_id', null, null);
    
    }

    public function tedesco() {

        return $this->belongsTo('App\Models\LivelloLinguistico', 'tedesco_livello_linguistico_id', null, null);
    
    }

    public function cinese() {

        return $this->belongsTo('App\Models\LivelloLinguistico', 'cinese_livello_linguistico_id', null, null);
    
    }

    public function corsi() {

        return $this->belongsToMany('App\Models\Corso', 'candidati_corsi', 'candidato_id', 'corso_id',
                                    null, null, null)
							->withPivot(['ordine']);
    
    }

    public function voti() {

        return $this->hasMany('App\Models\CandidatoVoti', 'candidato_id', null);
    
    }



}
