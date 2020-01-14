<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Http\BrokerClientInterface;

class GetMarginCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'margin';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'get current margin and balance';

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
        $margin = $this->client->getMargin();
	var_dump($margin);
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
