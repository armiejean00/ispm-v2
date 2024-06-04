<?php

namespace App\Console;

use App\Console\Commands\SendBookingNotifications;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('send:booking-notifications')->hourly();
       $schedule->command('send:booking-notifications')->daily();
     $schedule->command(SendBookingNotifications::class)->daily(); 
    }
    protected $commands = [
    \App\Console\Commands\SendBookingNotifications::class,
];

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}


