<?php

namespace App\Console;

use App\Jobs\OrderCome;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('sanctum:prune-expired --hours=24')->daily();
        // $schedule->command('inspire')->hourly();
        $schedule->job(new OrderCome())->twiceDaily(8, 20);
        // $schedule->job(new OrderCome())->dailyAt('02:24');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
