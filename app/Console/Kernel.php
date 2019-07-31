<?php

namespace App\Console;

use App\Console\Commands\CheckUsersPlans;
use App\Console\Commands\RemoveAdvertisements;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\RemoveAdvertisements::class,
        Commands\CheckUsersPlans::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(RemoveAdvertisements::class)->daily('2:00')
            ->timezone('America/Sao_Paulo');
        $schedule->command(CheckUsersPlans::class)->daily('1:00')
            ->timezone('America/Sao_Paulo');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
