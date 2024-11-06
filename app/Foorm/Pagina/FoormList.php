<?php

namespace App\Foorm\Pagina;


use Gecche\Cupparis\App\Foorm\Base\FoormList as BaseFoormList;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class FoormList extends BaseFoormList
{

    use PaginaTrait;
}
