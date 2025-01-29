<?php

namespace App\Events;

use App\Models\Esame;
use App\Models\Studente;
use Illuminate\Queue\SerializesModels;

class RichiestaScuola
{
    use SerializesModels;

    /** @var Esame */
    public $richiestaScuola;


    public function __construct(RichiestaScuola $richiestaScuola)
    {
        $this->richiestaScuola = $richiestaScuola;
    }
}
