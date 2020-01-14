<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Http\BrokerClientInterface;

class GetTicker extends Command
{
    //private $client;
    public function __construct(BrokerClientInterface $client)
    {
        $this->client = $client;
        parent::__construct();
    }
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'ticker';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Get XBTUSD Price';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ticker = $this->client->getTicker();
        $last_price = $ticker['last'];
        $this->info("\nXBTUSD Price: $last_price\n");
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
