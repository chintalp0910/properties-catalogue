<?php

namespace App\Console\Commands\OldRecords;

use App\ModelsExtended\News;
use Database\Seeders\StoreNewsImagesSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class NewsImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'old-records:news-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will migrate old news images';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!Schema::hasTable('news')) return 0;

        $this->withProgressBar(  News::all(),  function ( $item ){
            StoreNewsImagesSeeder::processNews($item);
        });

        $this->info( "\nCompleted processing news images.. \n" );
        return 0;
    }
}
