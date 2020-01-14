<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Http\BrokerClientInterface;

class OrdersCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'orders';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Get open orders';

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
        $orders = $this->client->getOpenOrders();
        $this->info("\nOpen Orders:");
        if(!$orders)
        {
            $this->info("No open orders at the moment\n");
        }
        else
        {
            foreach($orders as $order)
            {
                $orderID = $order['orderID'];
                $symbol = $order['symbol'];
                $side = $order['side'];
                $qty = $order['orderQty'];
                $price = $order['price'];
                $this->info("\nSymbol: $symbol\nSide: $side\nSize: $qty\nPrice: $price\nOrder ID: $orderID\n\n");

            }
        }
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
