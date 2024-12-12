<?php

namespace App\Foorm\Evento;


use App\Models\Evento;

trait EventoTrait
{

    public function createOptionsEvidenza($fieldValue,$defaultOptionsValues,$relationName = null,$relationMetadata = []) {

        return [
            1 => "Posizione 1",
            2 => "Posizione 2",
            3 => "Posizione 3",
            9 => "Speciale in footer",
        ];

    }

}
