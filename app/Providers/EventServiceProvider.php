<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Observers\TripObserver;
use App\Observers\TripBusObserver;
use App\Observers\ClientObserver;
use App\Observers\TripStatusObserver;
use App\Observers\DriverObserver;
use App\Observers\BusObserver;

use App\Models\DailyTripDetail;
use App\Models\TripBus;
use App\Models\Client;
use App\Models\Trip;
use App\Models\Driver;
use App\Models\Bus;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
        DailyTripDetail::observe(TripObserver::class);
        TripBus::observe(TripBusObserver::class);
        Client::observe(ClientObserver::class);
        Trip::observe(TripStatusObserver::class);
        Driver::observe(DriverObserver::class);
        Bus::observe(BusObserver::class);
    }   
}
