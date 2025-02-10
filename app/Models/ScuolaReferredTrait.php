<?php

namespace App\Models;


use Illuminate\Support\Facades\Log;

/**
 * Breeze (Eloquent) model for candidati table.
 */
trait ScuolaReferredTrait
{


    public function createReferredDataScuolaId($fieldValue)
    {
//        Log::info("SCUOLA::::".$this->getKey() . ' - ' . $this->scuola . ' - ' .  $this->scuola->getKey());
        if ($this->getKey() && $this->scuola && $this->scuola->getKey()) {
            return [
                'id' => $this->scuola->id,
                'denominazione' => $this->scuola->denominazione,
                'denominazione_istituto_riferimento' => $this->scuola->denominazione_istituto_riferimento,
                'codice' => $this->scuola->codice,
                'comune' => $this->scuola->comune,
                'comunesns|nome' => $this->scuola->comunesns->nome,
                'provincia|sigla' => $this->scuola->provincia->sigla,
            ];
        }
        return [
            'id' => null,
            'denominazione' => null,
            'denominazione_istituto_riferimento' => null,
            'codice' => null,
            'comune' => null,
            'comunesns|nome' => null,
            'provincia|sigla' => null,
        ];
    }



}
