<?php

namespace App\Foorm\Iniziativa;


use App\Models\Iniziativa;

trait IniziativaTrait
{

    public function createOptionsAnno($fieldValue,$defaultOptionsValues,$relationName = null,$relationMetadata = []) {

        $annoStart = date('Y') - 1;

        $options = range($annoStart, ($annoStart + 5));

        return array_combine($options,$options);

    }

    public function createOptionsModalitaCandidatura($fieldValue,$defaultOptionsValues,$relationName = null,$relationMetadata = []) {


        $options = Iniziativa::getModalitaCandidaturaOptions();
        return array_combine($options,$options);

    }

}
