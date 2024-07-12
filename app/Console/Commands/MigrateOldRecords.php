<?php

namespace App\Console\Commands;

use App\Console\Commands\OldRecords\EventImagesCommand;
use App\Console\Commands\OldRecords\NewsImagesCommand;
use App\Console\Commands\OldRecords\OldAgentsCommand;
use App\Console\Commands\OldRecords\OldPropertiesCommand;
use App\Console\Commands\OldRecords\PropertyImagesCommand;
use Illuminate\Console\Command;

class MigrateOldRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:old-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will migrate old records';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // only on development
//        Artisan::call( 'code:models' );
//
//        Artisan::call( 'db:seed --class MoveOldAgentsSeeder' );
//        Artisan::call( 'db:seed --class StoreEventsImagesSeeder' );
//        Artisan::call( 'db:seed --class StoreNewsImagesSeeder' );
//        Artisan::call( 'db:seed --class StoreOldPropertyImagesSeeder' );

//        Artisan::call( 'db:seed --class MoveOldPropertiesSeeder' );

//        $this->info( Artisan::output() );



//        $this->call(OldAgentsCommand::class );
        $this->call(EventImagesCommand::class );

        $this->call(NewsImagesCommand::class );

        $this->call(OldPropertiesCommand::class );

        $this->call(PropertyImagesCommand::class );


        return 0;
    }
}
