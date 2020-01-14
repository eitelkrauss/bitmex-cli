<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Http\BrokerClientInterface;

class CloseCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'close {side : Buy/Sell} {size : Enter size} {price : Enter price}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'ReduceOnly orders';

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
        $side = $this->argument('side');
        $price = $this->argument('price');
        $size = $this->argument ('size');
        $order = $this->client->createOrder("Limit", 
                                            $side,
                                            $price,
                                            $size,
                                            "ReduceOnly"
                                            );
        $this->info("\nClosing $size contracts @$$price\n");
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
