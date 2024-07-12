<?php

namespace App\Console\Commands\OldRecords;

use App\ModelsExtended\OldProperty;
use Database\Seeders\StoreOldPropertyImagesSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class PropertyImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'old-records:property-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will migrate old property images';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!Schema::hasTable('old_property')) return 0;

        $this->withProgressBar(  OldProperty::all(),  function ( $item ){
            StoreOldPropertyImagesSeeder::processImages($item);
        });

        $this->info( "\nCompleted processing property images.. \n" );
        return 0;
    }
}
