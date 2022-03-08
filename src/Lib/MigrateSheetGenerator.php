<?php

namespace Readerstacks\MigrateExcel\Lib;

use Readerstacks\MigrateExcel\Exports\MigrateExportViewSheet;

class MigrateSheetGenerator{
    private $title;
    private $view;
    private $data;
    private $sheet;
    private $dynamicMethods=[];
    
    public function __construct($title,$callback)
    {
        $this->title = $title;
        $this->callback=$callback;
    }
    public function loadView($view,$data){
        $this->view=$view;
        $this->data=$data;
        $class=config("migrate_excel_config.viewClass");
        $this->sheet=new $class($this->title, $this->view,$this->data,array($this, 'callMethods'));
         
        
        $cb=$this->callback;
        $cb($this->sheet);
         
        return $this;
    }


    public function callMethods($sheet){
        $class=config("migrate_excel_config.custom_handler_traits");
        if(isset($class) && !empty($class)){
              $handler =new  $class($sheet,"writespace");
        }
         
        foreach($this->dynamicMethods as $method=>$args){
            $this->callMethod($method,$args,$handler);
        }
        return $this;
    }
    public function fromArray($data){
      
        $this->data=$data;
        $class=config("migrate_excel_config.arrayClass");
        $this->sheet=new  $class($this->title,$this->data,array($this, 'callMethods') );
         
        $cb=$this->callback;
        $cb($this->sheet);
         
        return $this;
    }
    public function __call($name,$arguments){
        $this->dynamicMethods[$name]=$arguments;
        
        return $this;
    }

    public function callMethod($name,$arguments,$handler){

        $handler->$name(...$arguments);
    }
   
    
    
}