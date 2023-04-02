<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Validator, Exception, Image, URL;
use App\Models\Driver;
use App\Models\SuperVisor;
use App\Models\Bus;
use App\Models\BusSize;
use App\Models\Client;
use App\Models\City;
use App\Models\Area;
use App\Models\Trip;
use App\Models\DailyTripDetail;
use App\Models\TripBus;
use App\Models\Transaction;
use App\Models\Notification;
use Carbon\Carbon;


class DailyTripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daily_trip = DailyTripDetail::orderBy('daily_trip_details.id', 'DESC')->get();
        $client = Client::where('status', 1)->get();
        $city = City::where('status', 1)->get();
        $bus = Bus::where('status', 1)->get();
        $bus_size = BusSize::where('status', 1)->get();
        $driver = Driver::where('status', 1)->get();
        $trip = Trip::where('status', 1)->get();
        $area = Area::where('status', 1)->get();
        foreach ($daily_trip as $key => $value) {
            $value->client_name = Client::where('id', $value->client_name)->first()->name_en;
        }
        //return Carbon::createFromFormat('Y-m-d', $date)->setTime(00, 00, 00, 000000) + "";
        return view('admin.pages.dailyTrip.index', [
            'daily_trip' => $daily_trip,
            'client' => $client,
            'city' => $city,
            'bus' => $bus,
            'area' => $area,
            'bus_size' => $bus_size,
            'driver' => $driver,
            'trip' => $trip,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = Client::where('status', 1)->get();
        $city = City::where('status', 1)->get();
        $bus = Bus::where('status', 1)->get();
        $bus_size = BusSize::where('status', 1)->get();
        $driver = Driver::where('status', 1)->get();
        $trip = Trip::where('status', 1)->get();
        return view('admin.pages.dailyTrip.create', [
            'client' => $client,
            'city' => $city,
            'bus' => $bus,
            'bus_size' => $bus_size,
            'driver' => $driver,
            'trip' => $trip,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'trip_type' => 'required',
            'show_trip_admin' => 'required',
        ]);
        $attributeNames = array(
            'status' => 'Status',
            'trip_type' => 'Trip Type',
            'show_trip_admin' => 'Show Trip Admin',
        );
        $validator->setAttributeNames($attributeNames);
        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }


        /**
         * if id is not exist, then requst data will create.
         * if id is exist, then request data will update
         */
        if($request->id){
            $daily_trip = DailyTripDetail::findOrFail($request->id);
        } else {
            $daily_trip = new DailyTripDetail;
        }
        $daily_trip->trip_name = $request->tripe_name;
        $daily_trip->client_name = $request->client;
        $daily_trip->origin_city = $request->origin_city;
        $daily_trip->origin_area = $request->origin_area;
        $daily_trip->destination_area = $request->destination_area;
        $daily_trip->destination_city = $request->destination_city;
        $daily_trip->start_date = $request->start_trip_date;
        $daily_trip->start_time = $request->start_trip_time;
        $daily_trip->end_date = $request->end_trip_date;
        $daily_trip->end_time = $request->end_trip_time;
        $daily_trip->bus_size_id = $request->bus_size_id;
        $daily_trip->bus_no = $request->bus_no;
        $daily_trip->details = $request->details;

        $driver_value = $request->driver;
        $driver_name = explode('|', $driver_value);

        $daily_trip->dirver_name = $driver_name[0];
        $daily_trip->driver_id = $driver_name[1];

        $daily_trip->trip_type = $request->trip_type;
        $daily_trip->show_admin_status = $request->show_trip_admin;
        if ($request->status != 0) {
            $daily_trip->status = $request->status;
        }
        $daily_trip->supervisor = json_encode($request->supervisor);

        // $supervisor = json_decode($daily_trip->supervisor);
        // for ($i = 0; $i < count($supervisor); $i++) {
        //     app('App\Http\Controllers\Admin\SuperVisorController')->sendNotificationToSupervisor($supervisor[$i]);
        // }
        // app('App\Http\Controllers\Admin\DriverController')->sendNotificationToDriver($daily_trip->getRawOriginal('driver_id'));
        // app('App\Http\Controllers\Admin\DriverController')->sendNotificationToDriver($driver_name[1]);

        $daily_trip->save();
        return response()->json(['result' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::where('status', 1)->get();
        $city = City::where('status', 1)->get();
        $bus = Bus::where('status', 1)->get();
        $bus_size = BusSize::where('status', 1)->get();
        $driver = Driver::where('status', 1)->get();
        $trip = Trip::where('status', 1)->get();
        $daily_trip = DailyTripDetail::findOrFail($id);

        $start_date_str = $daily_trip->start_date;
        $end_date_str = $daily_trip->end_date;
        $start_date = date_create($start_date_str);
        $end_date = date_create($end_date_str);
        $start_date = date_format($start_date,"d/m/Y H:i:s");
        $end_date = date_format($end_date,"d/m/Y H:i:s");

        $daily_trip->start_date = $start_date;
        $daily_trip->end_date = $end_date;

        $supervisor = [];
        $supervisors = json_decode($daily_trip->supervisor);
        for ($i = 0; $i < count($supervisors); $i++) {
            $supervisor_tmp = SuperVisor::findOrFail($supervisors[$i]);
            array_push($supervisor, $supervisor_tmp);
        }

        return view('admin.pages.dailyTrip.view', [
            'client' => $client,
            'city' => $city,
            'bus' => $bus,
            'bus_size' => $bus_size,
            'driver' => $driver,
            'trip' => $trip,
            'daily_trip' => $daily_trip,
            'supervisor' => $supervisor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::where('status', 1)->get();
        $city = City::where('status', 1)->get();
        $bus = Bus::where('status', 1)->get();
        $bus_size = BusSize::where('status', 1)->get();
        $driver = Driver::where('status', 1)->get();
        $trip = Trip::where('status', 1)->get();
        $daily_trip = DailyTripDetail::findOrFail($id);

        $start_date_str = $daily_trip->start_date;
        $end_date_str = $daily_trip->end_date;
        $start_date = date_create($start_date_str);
        $end_date = date_create($end_date_str);
        $start_date = date_format($start_date,"d/m/Y");
        $end_date = date_format($end_date,"d/m/Y");

        $daily_trip->start_date = $start_date;
        $daily_trip->end_date = $end_date;
        $daily_trip->start_date_str = $start_date_str;
        $daily_trip->end_date_str = $end_date_str;

        $supervisor = SuperVisor::all();
        $supervisor_id = [];
        $supervisors = json_decode($daily_trip->supervisor);
        for ($i = 0; $i < count($supervisors); $i++) {
            // $supervisor_tmp = SuperVisor::findOrFail($supervisors[$i]);
            array_push($supervisor_id, $supervisors[$i]);
        }

        return view('admin.pages.dailyTrip.edit', [
            'client' => $client,
            'city' => $city,
            'bus' => $bus,
            'bus_size' => $bus_size,
            'driver' => $driver,
            'trip' => $trip,
            'daily_trip' => $daily_trip,
            'supervisor' => $supervisor,
            'supervisor_id' => $supervisors
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getArea($id) {
        $area = Area::where('id', $id)->first();
        return $area->area_name_en;
    }

    public function getCity($id) {
        $city = City::where("id", $id)->first();
        return $city->city_name_en;
    }

    public function addDailyTrip() {
        $trip = Trip::all();
            // $trip = Trip::where('trip_type', 0)->get();


            $flag = false;
            foreach ($trip as $trip_key) {
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
                        $daily_trip->f_trip_id = $trip_key->id;
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
                        $daily_trip->show_admin_status = $trip_key->admin_show;
                        $daily_trip->status = $trip_key->status;

                        $daily_trip->save();
                    }
                }

            }
    }

    public function getTodayTrip(Request $request) {
        $null_val = [];
        $driver_name = $request->get('driver_name');
        if ($driver_name == "") return response()->json(['result' => 'Invalid Input Data']);

        $today_month = Carbon::now()->format('m');
        $today_date = Carbon::now()->format('d');

        $return_val = [];
        $return_avatar = [];
        $daily_trip = [];
        $supervisor=$request->supervisor;
        if ($driver_name == "all") {
            $daily_trip = DailyTripDetail::whereJsonContains('supervisor',"$supervisor")->get();
        } else {
            $driver_name = Driver::where('id', $driver_name)->first()->name_en;
            $daily_trip = DailyTripDetail::where('dirver_name', $driver_name)->get();
        }
        // if (!$daily_trip) return response()->json(['result' => 'Invalid Driver']);
        foreach ($daily_trip as $daily_tripkey) {

            $trip_month = $daily_tripkey->created_at->format('m');
            $trip_date = $daily_tripkey->created_at->format('d');

            if ($today_month == $trip_month && $today_date == $trip_date) {
                // $daily_tripkey->dirver_name = Driver::where("id", $trip->dirver_name)->first()->name_en;

                // return response()->json(['month' => $trip_month, 'date' => $trip_date, 'tmonth' => $today_month, 'tdate' => $today_date]);
                // $daily_tripkey->origin_area = $this->getArea($daily_tripkey->origin_area);
                // $daily_tripkey->destination_area = $this->getArea($daily_tripkey->destination_area);
                // $daily_tripkey->origin_city = $this->getCity($daily_tripkey->origin_city);
                // $daily_tripkey->destination_city = $this->getCity($daily_tripkey->destination_city);

                $client = Client::findOrFail($daily_tripkey->client_name);
                $result = "http://167.86.102.230/alnabali/public/uploads/image/";
                $result .= $client->client_avatar;

                $daily_tripkey->client_avatar = $result;
                $daily_tripkey->client_name = $client->name_en;

                array_push($return_avatar, (object)[
                    $daily_tripkey->id => $result,
                ]);
                array_push($return_val, $daily_tripkey);
            }
        }

        return response()->json(['result' => $return_val, 'client_avatars' => $null_val]);
    }

    public function getLastTrip(Request $request) {
        $return_avatar = [];
        $null_val = [];
        $trips = DailyTripDetail::all();
        $daily_trips = [];
        foreach ($trips as $trip) {
            if ($request->driver_name != "all") {
                $driver_name = Driver::where('id', $request->driver_name)->first()->user_name;
                $daily_trips = DailyTripDetail::where('dirver_name', $driver_name)->get();
                foreach ($daily_trips as $key => $value) {
                    $client = Client::findOrFail($value->client_name);
                    $result = "http://167.86.102.230/alnabali/public/uploads/image/";
                    $result .= $client->client_avatar;
                    $value->client_avatar = $result;
                    $value->client_name = $client->name_en;
                }
            } else {
                $supervisors = $trip->supervisor;
                $supervisors = str_split($supervisors);
                $flag = in_array($request->supervisor, $supervisors);
                if ($flag) {

                    $client = Client::findOrFail($trip->client_name);
                    $result = "http://167.86.102.230/alnabali/public/uploads/image/";
                    $result .= $client->client_avatar;
                    $trip->client_avatar = $result;
                    $trip->client_name = $client->name_en;
                    array_push($return_avatar, (object)[
                        $trip->id => $result,
                    ]);

                    array_push($daily_trips, $trip);
                }
            }
            // $trip->dirver_name = Driver::where("id", $trip->dirver_name)->first()->name_en;

            // $trip->origin_area = $this->getArea($trip->origin_area);
            // $trip->destination_area = $this->getArea($trip->destination_area);
            // $trip->origin_city = $this->getCity($trip->origin_city);
            // $trip->destination_city = $this->getCity($trip->destination_city);

        }
        return response()->json(['result' => $daily_trips, 'client_avatars' => $null_val]);
    }

    public function getDailyTrip($id) {
        $trip = DailyTripDetail::find($id);

        // $trip->origin_area = $this->getArea($trip->origin_area);
        // $trip->destination_area = $this->getArea($trip->destination_area);
        // $trip->origin_city = $this->getCity($trip->origin_city);
        // $trip->destination_city = $this->getCity($trip->destination_city);

        // $trip->dirver_name = Driver::where("id", $trip->dirver_name)->first()->name_en;
        $client = Client::findOrFail($trip->client_name);
        $result = "http://167.86.102.230/alnabali/public/uploads/image/";
        $result .= $client->client_avatar;
        $trip->client_avatar = $result;
        $trip->client_name = $client->name_en;

        return response()->json(['result' => $trip]);
    }

    public function getAllArea() {
        $area = Area::all();
        return response()->json(['area' => $area]);
    }

    public function getAllCity() {
        $city = City::all();
        return response()->json(['city' => $city]);
    }



    public function setStatus(Request $request) {
        $cmdType = $request->get('command');
        $id = $request->get('id');
        $daily_trip = DailyTripDetail::where('id', $id)->first();
        if (!$daily_trip) return response()->json(['result' => 'Invalid Trip']);
        $return_val = "Changed to ";

        if ($cmdType == "accept") {
            $daily_trip->status = 2;
            $return_val .= $cmdType;
            $daily_trip->save();
        } else if ($cmdType == "reject") {
            $daily_trip->status = 3;
            $return_val .= $cmdType;
            $daily_trip->save();
        } else if ($cmdType == "cancel") {
            $daily_trip->status = 5;
            $return_val .= $cmdType;
            $daily_trip->save();
        } else if ($cmdType == "start") {
            $daily_trip->status = 4;
            $return_val .= $cmdType;
            $daily_trip->save();
        } else if ($cmdType == "finish") {
            $daily_trip->status = 6;
            $return_val .= $cmdType;
            $daily_trip->save();
        } else if ($cmdType == "fake") {
            $daily_trip->status = 7;
            $return_val .= $cmdType;
            $daily_trip->save();
        } else if ($cmdType == "pending") {
            $daily_trip->status = 1;
            $return_val .= $cmdType;
            $daily_trip->save();
        }

        return response()->json(['result' => $return_val]);
    }

    public function editDailyTrip(Request $request) {
        $id = $request->id;
        $bus_size = $request->bus_size;
        $bus = $request->bus;
        $driver = $request->driver;
        $status = 1;
        if ($request->status == "Pending") {
            $status = 1;
        } else if ($request->status == "Cancel") {
            $status = 5;
        } else if ($request->status == "Fake") {
            $status = 7;
        }

        // $detail = $request->detail;

        $daily_trip = DailyTripDetail::where('id', $id)->first();
        $daily_trip->status = $status;
        if ($request->status != "Fake") {
            $daily_trip->bus_size_id = $bus_size;
            $daily_trip->bus_no = $bus;
            $daily_trip->dirver_name = $driver;
        }
        // $daily_trip->details = $detail;
        $daily_trip->save();

        return response()->json(['result' => "success"]);
    }

}
