<?php

namespace Readerstacks\MigrateExcel\Lib;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MigrateGroupSheet implements WithMultipleSheets
{
    use Exportable;

    private $sheets;

    public function __construct($sheets)
    {
        $this->sheets = $sheets;
      
    }
    /**
     * @return array
     */
    public function sheets(): array
    { 

        return $this->sheets;
    }
}