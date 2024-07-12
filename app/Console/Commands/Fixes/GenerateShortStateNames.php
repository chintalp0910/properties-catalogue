<?php

namespace App\Console\Commands\Fixes;

use App\ModelsExtended\Property;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Command\Command as CommandAlias;

class GenerateShortStateNames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fixes:generate-short-state {limit? : the number of properties to go through}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will generate short state names';

    /**
     * Default is 1M
     * @var int
     */
    private int $limit = 1000000;

    /**
     * @param Property $property
     * @return void
     */
    public static function updatePropertyShortState(Property $property): void
    {
        try {
            $property->setShortStateNameUsingGoogleApi();
            $property->updateQuietly();
        }catch (GuzzleException $exception)
        {
            Log::info( "Could not update the state of this property with ID: " . $property->id, [
                $exception->getMessage(),
                $exception->getTrace()
            ]);
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->limit = $this->argument('limit')?? $this->limit;

        $this->withProgressBar($this->getProperties($this->limit), function (Property $property){
            self::updatePropertyShortState($property);
        });

        $this->info( "\nCompleted" );

        return CommandAlias::SUCCESS;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|Collection
     */
    private function getProperties(int $limit): Collection|array
    {
        return Property::query()
            ->whereNull('short_state_name')
            ->orWhereRaw("length(state) <= 2")
            ->limit($limit)
            ->get();
    }
}
