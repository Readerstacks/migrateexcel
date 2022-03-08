<?php

namespace Readerstacks\MigrateExcel;

use Illuminate\Support\ServiceProvider;
use Readerstacks\MigrateExcel\Lib\MigrateExcel;
 
class MigrateExcelServiceProvider extends ServiceProvider
{

     
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
         
        
        $this->publishes([
            __DIR__.'/migrate_excel_config.php' => config_path('migrate_excel_config.php','migrate_excel_config'),
        ]);
        $this->app->bind('migrateexcel',function(){
            return new MigrateExcel();
        });
       
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->mergeConfigFrom(
            __DIR__.'/migrate_excel_config.php' ,'migrate_excel_config'
        );
      
    }
}
