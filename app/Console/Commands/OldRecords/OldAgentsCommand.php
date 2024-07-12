<?php

namespace App\Console\Commands\OldRecords;

use App\Models\OldAgent;
use Database\Seeders\MoveOldAgentsSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class OldAgentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'old-records:move-agents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will migrate old agents record';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if(! Schema::hasTable('old_agents') ) return 0;

        $this->withProgressBar(    OldAgent::all() ,  function ( $item ){
            MoveOldAgentsSeeder::process($item);
        });

        $this->info( "\nCompleted processing agents.. \n" );
        return 0;
    }
}
