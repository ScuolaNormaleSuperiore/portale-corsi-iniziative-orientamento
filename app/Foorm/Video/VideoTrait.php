<?php

namespace App\Foorm\Video;


use App\Models\Video;

trait VideoTrait
{

    public function createOptionsOrdine($fieldValue,$defaultOptionsValues,$relationName = null,$relationMetadata = []) {

        return array_combine(range(1,20),range(1,20));

    }

}
