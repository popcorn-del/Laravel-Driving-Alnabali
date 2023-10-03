<?php

namespace App\Observers;

use App\Models\Driver;
use App\Models\TripBus;
use Carbon\Carbon;


class DriverObserver
{
    /**
     * Handle the Driver "created" event.
     *
     * @param  \App\Models\Driver  $driver
     * @return void
     */
    public function created(Driver $driver)
    {
        
    }

    /**
     * Handle the Driver "updated" event.
     *
     * @param  \App\Models\Driver  $driver
     * @return void
     */
    public function updated(Driver $driver)
    {
        if ($driver->isDirty('status') && $driver->status == 0) {
            \Log::info("*****======-----DriverObserver::create-----======*****");
            
            $driver_id = $driver->id;
            TripBus::setInactive('driver_name',$driver_id);
        }
    }

    /**
     * Handle the Driver "deleted" event.
     *
     * @param  \App\Models\Driver  $driver
     * @return void
     */
    public function deleted(Driver $driver)
    {
        //
    }

    /**
     * Handle the Driver "restored" event.
     *
     * @param  \App\Models\Driver  $driver
     * @return void
     */
    public function restored(Driver $driver)
    {
        //
    }

    /**
     * Handle the Driver "force deleted" event.
     *
     * @param  \App\Models\Driver  $driver
     * @return void
     */
    public function forceDeleted(Driver $driver)
    {
        //
    }
}
