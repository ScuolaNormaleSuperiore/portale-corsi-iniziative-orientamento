<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ModelArrayExport implements FromArray, WithColumnFormatting
{

    protected $rows;
    protected $columnsFormats = null;

    public function __construct(array $rows,$columnsFormats = null)
    {
        $this->rows = $rows;
        $this->columnsFormats = $columnsFormats;
    }

    public function array(): array
    {
        return $this->rows;
    }

    public function columnFormats(): array
    {
        if (is_array($this->columnsFormats)) {
            return $this->columnsFormats;
        }

        return [];
    }
}
