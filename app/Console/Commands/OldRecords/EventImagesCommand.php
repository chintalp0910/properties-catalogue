<?php

namespace App\Console\Commands\OldRecords;

use App\Models\OldAgent;
use App\ModelsExtended\Event;
use Database\Seeders\MoveOldAgentsSeeder;
use Database\Seeders\StoreEventsImagesSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class EventImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'old-records:event-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will migrate old event images';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!Schema::hasTable('events')) return 0;

        $this->withProgressBar(  Event::all(),  function ( $item ){
            StoreEventsImagesSeeder::process($item);
        });

        $this->info( "\nCompleted processing event images.. \n" );
        return 0;
    }
}
