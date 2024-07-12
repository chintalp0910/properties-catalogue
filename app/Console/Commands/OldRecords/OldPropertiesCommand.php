<?php

namespace App\Console\Commands\OldRecords;

use App\ModelsExtended\OldProperty;
use Database\Seeders\MoveOldPropertiesSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class OldPropertiesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'old-records:move-properties';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will migrate old properties record';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if(! Schema::hasTable('old_property') ) return 0;

        $this->withProgressBar(   OldProperty::all() ,  function ( $item ){
            MoveOldPropertiesSeeder::process($item);
        });

        $this->info( "\nCompleted processing properties.. \n" );
        return 0;
    }
}
