<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Http\BrokerClientInterface;

class ShortCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'short 
                    {size : Enter position size}
                    {price : Enter price}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'SHORT x amount of contracts at x price';

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
        $this->client->createOrder("Limit", 
                                   "Sell",
                                    $this->argument('price'),
                                    $this->argument('size'),
                                    );
        $this->info("\nSelling ".$this->argument('size')." contracts @ $".$this->argument('price')."\n");
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
