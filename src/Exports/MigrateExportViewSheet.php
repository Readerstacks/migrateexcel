<?php

namespace Readerstacks\MigrateExcel\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
 
use Maatwebsite\Excel\Events\AfterSheet;

class MigrateExportViewSheet implements FromView,WithTitle ,WithEvents
{
  
    private $title;
    private $view;
    private $data;
    private $onEvent;

    public function __construct($title,$view,$data,$onEvent)
    {
        $this->title = $title;
        $this->view=$view;
        $this->data=$data;
        $this->onEvent=$onEvent;
    }

    public function view(): View
    {
        return view($this->view, $this->data);
    }

     
      /**
     * @return string
     */
    public function title(): string
    {
        return  $this->title;
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
