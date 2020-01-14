<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Http\BrokerClientInterface;

class LongCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'long {size : Enter position size} {price : Enter price}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'LONG x amount of contracts at x price';

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
                                   "Buy",
                                    $this->argument('price'),
                                    $this->argument('size'),
                                    );
        $this->info("\nBuying ".$this->argument('size')." contracts @ $".$this->argument('price')."\n");
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
