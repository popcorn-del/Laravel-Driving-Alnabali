<?php

namespace App\Observers;

use App\Models\Trip;
use App\Models\TripBus;
use Carbon\Carbon;


class TripStatusObserver
{
    /**
     * Handle the Trip "created" event.
     *
     * @param  \App\Models\Trip  $trip
     * @return void
     */
    public function created(Trip $trip)
    {
        
    }

    /**
     * Handle the Trip "updated" event.
     *
     * @param  \App\Models\Trip  $trip
     * @return void
     */
    public function updated(Trip $trip)
    {
        if ($trip->isDirty('status') && $trip->status == 0) {
            \Log::info("*****======-----TripObserver::create-----======*****");
            
            $trip_id = $trip->id;
            TripBus::setInactive('trip_name',$trip_id);
        }
    }

    /**
     * Handle the Trip "deleted" event.
     *
     * @param  \App\Models\Trip  $trip
     * @return void
     */
    public function deleted(Trip $trip)
    {
        //
    }

    /**
     * Handle the Trip "restored" event.
     *
     * @param  \App\Models\Trip  $trip
     * @return void
     */
    public function restored(Trip $trip)
    {
        //
    }

    /**
     * Handle the Trip "force deleted" event.
     *
     * @param  \App\Models\Trip  $trip
     * @return void
     */
    public function forceDeleted(Trip $trip)
    {
        //
    }
}
