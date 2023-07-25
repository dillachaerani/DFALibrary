<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class GeneralImport implements WithHeadingRow
{
    use Importable;
    protected $rowHeading;

    public function __construct($rowHeading = 1)
    {
        $this->rowHeading = $rowHeading;
    }

    public function headingRow(): int
    {
        return $this->rowHeading;
    }
}
