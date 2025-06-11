<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $sourceWallets = \App\Models\Wallet::where('type', 'source')->get();
            foreach ($sourceWallets as $wallet) {
                \App\Jobs\SweepWalletJob::dispatch($wallet);
            }
        })->dailyAt('01:00'); // Adjust frequency/time as needed
    }


    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
