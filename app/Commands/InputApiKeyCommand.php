<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Http\BrokerClientInterface;

class InputApiKeyCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'apikey';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Provide your BitMEX API key  <============  FIRST!';

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
        $json_file = __DIR__."/../../config/apikey.json";
        $api_key_json = json_decode(file_get_contents($json_file));
        if(!$api_key_json->id)
        {
            $api_key_json->id = $this->ask("ID:");
            $api_key_json->secret = $this->ask("Secret:");
        $write_json = file_put_contents($json_file, json_encode($api_key_json));
        $this->info("New config file for API key created\n");
        }
        else
        {
            $this->info("API key config file is ready\n");
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
