<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Driver;
use App\Models\Bus;
use App\Models\BusSize;
use App\Models\Client;
use App\Models\City;
use App\Models\Area;
use App\Models\Trip;
use App\Models\TripBus;
use App\Models\DailyTripDetail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // DailyTripDetail::truncate();
        \Log::info("Cron is working fine!");
        $flag = false;
        // $schedule->command('inspire')->hourly();
        $schedule->call(function() { 
            
        });

        $schedule->command('day:update')->dailyAt('00:05')->withoutOverlapping();
        // $schedule->command('day:update')->everyFiveMinutes()->withoutOverlapping();

        $schedule->command('five:update')->everyFiveMinutes()->withoutOverlapping();
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

    private function periodTrip() 
    {

    }

    private function nonPeriodTrip()
    {

    }
}
