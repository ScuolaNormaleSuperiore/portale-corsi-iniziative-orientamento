<?php

namespace App\Foorm\Pagina;


use App\Models\Pagina;

trait PaginaTrait
{

    public function createOptionsOrdine($fieldValue,$defaultOptionsValues,$relationName = null,$relationMetadata = []) {

        return array_combine(range(1,20),range(1,20));

    }

}
