<?php

namespace Readerstacks\MigrateExcel\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;

use Illuminate\Contracts\View\View;

class MigrateExportArraySheet implements FromArray,WithTitle,WithEvents
// ,WithEvents
{
  
    private $title;
    private $view;
    private $data;
    private $onEvent;
    private $orientation;
    private $fontSize;

    
    public function __construct($title,$data,$onEvent)
    {
        $this->title = $title;
        $this->data=$data;
        $this->onEvent=$onEvent;
        
    }

    public function array(): array
    {
        return  $this->data;
    }
 

   
   
     
    /**
     * @return string
     */
    public function title(): string
    {
        return  $this->title;
    }

    function setOrientation($type){
        $this->orientation=$type;
    }
    function setFontSize($fontSize){
        $this->fontSize=$fontSize;
    }
    function prependRow($num,$arr){
        
    }
    function freezeFirstRow(){
       
      
    }
    


    public function registerEvents(): array
    {
        
        return [
            // Handle by a closure.
            BeforeExport::class => function(BeforeExport $event) {
                $event->writer->getProperties()->setCreator('Patrick');
            },
            
            // Array callable, refering to a static method.
            BeforeWriting::class => [self::class, 'beforeWriting'],
            
            // Using a class with an __invoke method.
           
            AfterSheet::class => function(AfterSheet $sheet){
                $onEvent=$this->onEvent;
                $onEvent($sheet);    
                
            }
        ];
    }

     
    

     
}
