<?php

namespace Readerstacks\MigrateExcel\Lib;

 
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;


class MigrateImportArraySheet implements ToCollection
 
{
    use Importable;
    
 
    
    public function collection(Collection $rows)  :Collection
    {
         
        return  $rows;
    }


     


     
     

     
    

     
}
