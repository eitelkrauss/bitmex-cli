<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Http\BrokerClientInterface;

class EditOrderCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'amend
                {--price= : Enter Price} 
                {--size= : Enter Size}
                ';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Amend open orders';

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
        $orderID = $this->ask('Enter Order ID');
        //$orderID = $this->argument('orderID');
        $price = $this->option('price');
        $size = $this->option('size');
        $order = $this->client->editOrder($orderID, $price, $size);
        $this->info("Order amended\n");
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
