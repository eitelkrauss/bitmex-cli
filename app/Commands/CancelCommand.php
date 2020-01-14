<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Http\BrokerClientInterface;

class CancelCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'cancel
                        {--all : Cancel all open orders}
                        ';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Cancel --all or submit a specific orderID';

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
        $this->option('all')
        ? $this->client->cancelAllOpenOrders() && $this->info("\nAll open orders cancelled\n")
        : $this->client->cancelOrder($this->ask('Enter Order ID')) && $this->info("Order cancelled\n");
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
