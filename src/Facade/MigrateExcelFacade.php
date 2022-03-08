<?php

namespace Readerstacks\MigrateExcel\Facade;
 
use Illuminate\Support\Facades\Facade;
 

class MigrateExcelFacade  extends Facade
{ 
    private $name;
    private $callback;

    protected static function getFacadeAccessor()
    {
        return 'migrateexcel'; // same as bind method in service provider
    }
   

}