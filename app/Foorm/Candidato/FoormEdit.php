<?php

namespace App\Foorm\Candidato;


use Gecche\Cupparis\App\Foorm\Base\FoormEdit as BaseFoormEdit;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class FoormEdit extends BaseFoormEdit
{

    protected $step;

    protected $autosave = false;

    public function setAutosave(bool $autosave) {
        $this->autosave = $autosave;
    }

    use CandidatoTrait;


}
