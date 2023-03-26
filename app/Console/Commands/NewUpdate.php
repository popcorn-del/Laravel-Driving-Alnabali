<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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

class NewUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'five:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today()->toDateString();
        $newtrips = Trip::whereDate('created_at', $today)->get();

        if (count($newtrips) == 0) {
            return 0;
        }

        foreach ($newtrips as $trip_key) {
            $now = Carbon::today();
        
            $now_dayofweek = Carbon::now()->dayOfWeek + 1;
            $now_dayofweek = (string)$now_dayofweek;
            $now_year = Carbon::now()->format('Y');
            $now_month = Carbon::now()->format('m');
            $now_date = Carbon::now()->format('d');
            $date = $trip_key->first_trip_date;
            $get_year = Carbon::createFromFormat('Y-m-d', $date)->format('Y');
            $get_month = Carbon::createFromFormat('Y-m-d', $date)->format('m');
            $get_date = Carbon::createFromFormat('Y-m-d', $date)->format('d');

            $last_date = $trip_key->last_trip_date;
            $get_year_last = Carbon::createFromFormat('Y-m-d', $last_date)->format('Y');
            $get_month_last = Carbon::createFromFormat('Y-m-d', $last_date)->format('m');
            $get_date_last = Carbon::createFromFormat('Y-m-d', $last_date)->format('d');

            $trip_frequency = $trip_key->trip_frequancy;
            $trip_frequency = str_split($trip_frequency);
            $dayflag = in_array($now_dayofweek, $trip_frequency);

            $newDate = Carbon::createFromFormat('Y-m-d', $date)->setTime(00, 00, 00, 000000);
            $newLastDate = Carbon::createFromFormat('Y-m-d', $last_date)->setTime(00, 00, 00, 000000);

            if (($now->gte($newDate) && $now->lte($newLastDate) && $dayflag) || ($now->eq($newDate) && $now->eq($newLastDate))) {
                $tripbus_data = TripBus::where('trip_name', $trip_key->id)->get();
                foreach ($tripbus_data as $tripbus_key) {
                    $daily_trip = new DailyTripDetail;
                    $daily_trip->trip_name = $trip_key->trip_name_en;


                    $temp = DailyTripDetail::where('start_date', Carbon::now()->toDateString())->get();
                    $trip_id_str = Carbon::now()->format('Y') . Carbon::now()->format('m') . Carbon::now()->format('d') . '-' . (count($temp) + 1);
                    $daily_trip->trip_id = $trip_id_str;

                    // $client_data = Client::where('id', $trip_key->client_id)->first();
                    // $daily_trip->client_name = $client_data->name_en;
                    $daily_trip->client_name = $trip_key->client_id;

                    // $daily_trip->origin_city = $trip_key->origin_city;
                    // $daily_trip->origin_area = $trip_key->origin_area;
                    // $daily_trip->destination_area = $trip_key->destination_area; 
                    // $daily_trip->destination_city = $trip_key->destination_city;

                    $daily_trip->origin_city = City::where('id', $trip_key->origin_city)->first()->city_name_en;
                    $daily_trip->origin_area = Area::where('id', $trip_key->origin_area)->first()->area_name_en;
                    $daily_trip->destination_area = Area::where('id', $trip_key->destination_area)->first()->area_name_en;
                    $daily_trip->destination_city = City::where('id', $trip_key->destination_city)->first()->city_name_en;
                    
                    $daily_trip->start_date = Carbon::now()->toDateString();
                    $daily_trip->start_time = $trip_key->departure_time;
                    $daily_trip->f_trip_id = $trip_key->id;
                    // $daily_trip->start_time = $mytime;
                    
                    $daily_trip->end_date = Carbon::now()->toDateString();
                    $daily_trip->end_time = $trip_key->arrival_time;

                    $bus_size = BusSize::where('id', $tripbus_key->bus_size)->first();
                    $daily_trip->bus_size_id = $bus_size->size;
                    $daily_trip->f_bus_size_id = $bus_size->id;

                    $bus_no = Bus::where('id', $tripbus_key->bus_no)->first();
                    $daily_trip->bus_no = $bus_no->bus_no;
                    $daily_trip->f_bus_id = $bus_no->id;

                    $daily_trip->details = $trip_key->details;

                    $driver_name = Driver::where('id', $tripbus_key->driver_name)->first();
                    $daily_trip->dirver_name = $driver_name->name_en;
                    $daily_trip->driver_id = $tripbus_key->driver_name;
                    // $daily_trip->dirver_name = $tripbus_key->driver_name;

                    // app('App\Http\Controllers\Admin\DriverController')->sendNotificationToDriver($tripbus_key->driver_name);

                    $daily_trip->supervisor = $tripbus_key->supervisor_name;
                    // $supervisor_id = json_decode($tripbus_key->supervisor_name);
                    // for ($i = 0; $i < count($supervisor_id); $i++) {
                    //     app('App\Http\Controllers\Admin\SuperVisorController')->sendNotificationToSupervisor($supervisor_id[$i]);
                    // }
                    
                    $daily_trip->trip_type = $trip_key->trip_type;
                    // $daily_trip->show_admin_status = $trip_key->admin_show;
                    $daily_trip->status = $trip_key->status;
    
                    $trip_key->created_at = Carbon::yesterday();
                    $trip_key->save();

                    $daily_trip->save();
                }
            }

        }
    }
}
