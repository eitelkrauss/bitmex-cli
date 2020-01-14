<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Http\BrokerClientInterface;

class GetPositionsCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'positions';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Get open positions';

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    
     private $client;
    public function __construct(BrokerClientInterface $client)
    {
        $this->client = $client;
        parent::__construct();
    }
    

    public function handle()
    {   
        $positions = $this->client->getOpenPositions();
        if(!$positions)
        {
            $this->info("\nNo open positions at the moment\n");
        }
        else
        {
            foreach($positions as $position)
            {
                $qty = $position['currentQty'];
                $entry = $position['avgEntryPrice'];
                $symbol = $position['symbol'];
                $qty > 0
                    ? $this->info("\nLONG $qty contracts on $symbol\nAverage entry: $$entry\n")
                    : $this->info("\nSHORT $qty contracts on $symbol\nAverage entry: $$entry\n");
            }
        }
	print_r($positions);
    }
    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}

