<?php

namespace App\Observers;

use App\Models\Bus;
use App\Models\TripBus;
use Carbon\Carbon;


class BusObserver
{
    /**
     * Handle the Bus "updated" event.
     *
     * @param  \App\Models\Bus  $bus
     * @return void
     */
    public function updated(Bus $bus)
    {
        \Log::info("*****======-----BusObserver::create-----======*****");
        if ($bus->isDirty('status') && $bus->status == 0) {
            \Log::info("*****======-----BusObserver::create-----======*****");
            
            $bus_id = $bus->id;
            TripBus::setInactive('bus_no',$bus_id);
        }
    }
}
