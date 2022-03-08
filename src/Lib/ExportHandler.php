<?php
namespace Readerstacks\MigrateExcel\Lib;
 
use Illuminate\Support\Facades\Log;

class ExportHandler
{
    private $sheet;
    private $writer;
    function __construct($sheet,$writer)
    {
        $this->sheet = $sheet;
        $this->writer =$writer;
    }

    function setOrientation($type){
       
        $this->sheet->sheet->getDelegate()->getPageSetup()->setOrientation($type);
    }

    function setFontSize($size){
       
        $this->sheet->sheet->getDelegate()->getParent()->getDefaultStyle()->getFont()->setSize($size);
    }
    function prependRow($row){

    }
    function freezeFirstRow(){

    }
    

     
}