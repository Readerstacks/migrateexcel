<?php

namespace Readerstacks\MigrateExcel\Lib;
 
use Maatwebsite\Excel\Facades\Excel;
 

class MigrateImportExcel  
{ 
    private $file;
    private $excel;
    private $cb;
   
    function __construct($file,$cb)
    {
        $this->file=  $file;
        $this->cb   =  $cb;
        $this->excel=  (new MigrateImportArraySheet());

        $cb( $this->excel->toCollection($this->file));
    }

 
    public function toArray()
    {
        return  $this->excel->toArray($this->file);
    }

    

}