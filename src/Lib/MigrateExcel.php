<?php

namespace Readerstacks\MigrateExcel\Lib;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Session;
Use Config;

class MigrateExcel  
{ 
    private $name;
    private $callback;

   
    public  function create($name,$callback){
        
        $this->name=$name;
        $this->callback=$callback;
        $callback($this);
        return $this;
    }
    public function export($type)
    {
        return Excel::download(new MigrateGroupSheet($this->sheets), $this->name.'.xlsx');
    }


    public function load($file,$cb=null)
    {
        $MigrateImportExcel = new MigrateImportExcel($file,$cb);
        
        return  $MigrateImportExcel;
       
    }
    public function download($type)
    {
        return Excel::download(new MigrateGroupSheet($this->sheets), $this->name.'.xlsx');
    }

    public function sheet($title="Sheet",$callbackSheet){
        $sheet=new MigrateSheetGenerator($title,function($sheet){
            $this->sheets[]=$sheet;
        });
        
        $callbackSheet($sheet);
    }
   

}