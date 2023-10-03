<?php

namespace App\Observers;

use App\Models\TripBus;
use App\Models\Trip;
use Carbon\Carbon;


class TripBusObserver
{
    /**
     * Handle the TripBus "created" event.
     *
     * @param  \App\Models\TripBus  $tripBus
     * @return void
     */
    public function created(TripBus $tripBus)
    {
        //
        \Log::info("*****======-----TripBusObserver::create-----======*****");
        
        $trip_id = $tripBus->trip_name;
        $trip = Trip::where('id', $trip_id)->first();
        $trip->created_at = Carbon::today();
        $trip->save();
    }

    /**
     * Handle the TripBus "updated" event.
     *
     * @param  \App\Models\TripBus  $tripBus
     * @return void
     */
    public function updated(TripBus $tripBus)
    {
        //
    }

    /**
     * Handle the TripBus "deleted" event.
     *
     * @param  \App\Models\TripBus  $tripBus
     * @return void
     */
    public function deleted(TripBus $tripBus)
    {
        //
    }

    /**
     * Handle the TripBus "restored" event.
     *
     * @param  \App\Models\TripBus  $tripBus
     * @return void
     */
    public function restored(TripBus $tripBus)
    {
        //
    }

    /**
     * Handle the TripBus "force deleted" event.
     *
     * @param  \App\Models\TripBus  $tripBus
     * @return void
     */
    public function forceDeleted(TripBus $tripBus)
    {
        //
    }
}
