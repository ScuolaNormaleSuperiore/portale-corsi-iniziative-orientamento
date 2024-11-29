<?php

namespace App\Foorm\Candidato;


use Gecche\Cupparis\App\Foorm\Base\FoormInsert as BaseFoormInsert;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class FoormInsert extends BaseFoormInsert
{
    protected $step;

    use CandidatoTrait;

}
