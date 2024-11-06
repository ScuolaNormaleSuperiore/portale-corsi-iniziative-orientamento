<?php

namespace App\ImageFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Logo implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(400,80);
    }
}
