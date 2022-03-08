<?php

namespace Readerstacks\MigrateExcel\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class MigrateExportViewSheet implements FromView,WithTitle
// ,WithEvents
{
  
    private $title;
    private $view;
    private $data;
    
    public function __construct($title,$view,$data)
    {
        $this->title = $title;
        $this->view=$view;
        $this->data=$data;
        
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
     

     
}
