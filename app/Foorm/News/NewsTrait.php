<?php

namespace App\Foorm\News;


use App\Models\News;

trait NewsTrait
{

    public function createOptionsEvidenza($fieldValue,$defaultOptionsValues,$relationName = null,$relationMetadata = []) {

        return [
            1 => "In alto",
            2 => "In basso (1)",
            3 => "In basso (2)",
            4 => "In basso (3)",
        ];

    }

}
