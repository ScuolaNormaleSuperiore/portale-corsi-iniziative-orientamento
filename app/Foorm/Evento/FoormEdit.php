<?php

namespace App\Foorm\Evento;


use Gecche\Cupparis\App\Foorm\Base\FoormEdit as BaseFoormEdit;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class FoormEdit extends BaseFoormEdit
{

    use EventoTrait;
}
