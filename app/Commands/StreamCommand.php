<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class StreamCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'stream';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Stream XBTUSD trades';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("\nConnecting to Websocket stream . . .\nPress 'Ctrl + C' to exit\n");
        //sleep(1);
        shell_exec("gnome-terminal --geometry 35x44+1400+100 -- php ".__DIR__."/../PlugIns/stream.php");
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
