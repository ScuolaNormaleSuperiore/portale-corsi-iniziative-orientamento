<?php

namespace App\Foorm\PaginaInfo;

trait PaginaInfoTrait
{

    public function createOptionsOrdine($fieldValue,$defaultOptionsValues,$relationName = null,$relationMetadata = []) {

        return array_combine(range(1,20),range(1,20));

    }

}
