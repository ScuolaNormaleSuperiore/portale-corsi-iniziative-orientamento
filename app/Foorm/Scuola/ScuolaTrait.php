<?php

namespace App\Foorm\Scuola;


use App\Models\Scuola;

trait ScuolaTrait
{

    public function createOptionsAreaGeografica($fieldValue,$defaultOptionsValues,$relationName = null,$relationMetadata = []) {

        $aree = [
            'CENTRO',
            'ISOLE',
            'NORD EST',
            'NORD OVEST',
            'SUD'
        ];

        return array_combine($aree,$aree);

    }

}
