<?php

namespace App\Foorm\News;


use Gecche\Cupparis\App\Foorm\Base\FoormList as BaseFoormList;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class FoormList extends BaseFoormList
{

    use NewsTrait;
}
