<?php

namespace App\Foorm\PaginaOrientamento;


use Gecche\Cupparis\App\Foorm\Base\FoormList as BaseFoormList;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class FoormList extends BaseFoormList
{

    use PaginaOrientamentoTrait;
}
