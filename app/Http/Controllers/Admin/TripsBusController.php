<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;
use App\Models\Bus;
use App\Models\BusSize;
use App\Models\Trip;
use App\Models\Client;
use App\Models\Driver;
use App\Models\TripBus;
use App\Models\SuperVisor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class TripsBusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $trip_bus = TripBus::leftJoin('trips', 'trip_buses.trip_name', '=', 'trips.id')
                  ->leftJoin('buses', 'trip_buses.bus_no', '=', 'buses.id')
                  ->leftJoin('bus_sizes', 'trip_buses.bus_size', '=', 'bus_sizes.id')
                  ->leftJoin('drivers', 'trip_buses.driver_name', '=', 'drivers.id')
                  ->select('trip_buses.*', 'trips.trip_name_en', 'trips.trip_name_ar', 'trip_buses.id', 'trips.id as trip_id', 'buses.bus_no','bus_sizes.size','drivers.name_en')->orderBy('trip_buses.id', 'DESC')
                  ->get();
        foreach ($trip_bus as $key => $trip_bus_key) {
            $supervisors = json_decode($trip_bus_key->supervisor_name);
            $tmp = "";
            if($supervisors != null) {
                foreach ($supervisors as $key => $supervisor) {
                    $supervisor_name = SuperVisor::where('id', $supervisor)->first();
                    $tmp .= $supervisor_name->name;
                    $tmp .= ',';
                    $trip_bus_key->supervisor = $tmp;
                }
            }
        }
        $lang=app()->getLocale();
        // return $trip_bus;
        return view('admin.pages.tripBus.index', [
            "trip_bus" => $trip_bus,
            "lang"=>$lang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request )
    {
        $client_id = $request['client'];

        //
        if($client_id == null) {
            $trip = Trip::where('status', 1)->orderby('trip_name_en','asc')->get();
        }
        else if($client_id == "") {
            $trip = Trip::where('status', 1)->orderby('trip_name_en','asc')->get();
        }
        else {
            $trip = DB::select('select * from trips where client_id = ? and status = ?', array($client_id, "1"));
        }

        $bus_size = BusSize::where('status', 1)->orderby('size','asc')->get();
        $bus_no = Bus::where('status', 1)->orderby('bus_no','asc')->get();
        $driver= Driver::where('status',1)->orderby('name_en','asc')->get();
        $client = Client::where('status', 1)->orderBy('name_en', 'asc')->get();
        $supervisor = SuperVisor::where('status', 1)->orderby('name','asc')->get();
        $trip_bus= TripBus::where('created_at', '<', date("Y-m-d h:i:s"))->get();
        $drivers = [];
        for ($i=0; $i < count($driver); $i++) {
            $is_used = true;
            if ($is_used == true) {
                $drivers[] = $driver[$i];
            }
        }
        // return $drivers;
        $lang=app()->getLocale();
        return view('admin.pages.tripBus.create', [
            'trip' => $trip,
            'bus_size' => $bus_size,
            'client' => $client,
            'bus_no' => $bus_no,
            'driver' => $driver,
            'supervisor' => $supervisor,
            'lang'=>$lang,
            'client_id' => $client_id
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
            $trip_id = $request->trip_name;
            $dest_freqs = Trip::where('id', $trip_id)->first();
            $dest_freq = json_decode($dest_freqs->trip_frequancy);

        // in_array("5", (json_decode($trip->trip_frequancy)))
        // return $dest_freq;
            // $freq_arr = $request->trip_frequancy;
            // if($request->trip_frequancy) {
            //     foreach ($freq_arr as $iter_arr) {
            //         if (in_array($iter_arr, $dest_freq) == true) {
            //             return response()->json(['result' => "fail"]);
            //         }
            //     }
            // }

            $trip_bus = new TripBus;
            $trip_bus->trip_name = $request->trip_name;
            $trip_bus->bus_size = $request->bus_size;
            $trip_bus->bus_no = $request->bus_no == null ? "" : $request->bus_no;
            $trip_bus->driver_name = $request->driver_name == null ? "" : $request->driver_name;
            $trip_bus->supervisor_name = json_encode($request->supervisor);
            $trip_bus->bus_frequancy = json_encode($request->trip_frequancy);
            $trip_bus->status = $request->status;
            $trip_bus->fake = $request->fake;

            $old_trip_bus = TripBus::where('trip_name',$request->trip_name)
                                    ->where('bus_no', $request->bus_no)
                                    ->where('bus_frequancy', json_encode($request->trip_frequancy))
                                    ->first();
            if(!is_null($old_trip_bus)) {
                return response()->json(['result' => "fail"]);
            }

            if ($request->bus_no == null && $request->fake == 0) {
                return response()->json(['result' => "fail"]);
            }
            $trip_bus->save();
            return response()->json(['result' => "success"]);

    }

    /**
     * Display the specified resource.
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data = TripBus::where('id', $id)->where('status', 1)->get();
        // return response()->json(['data' => $data]);
        $trip_bus = TripBus::where('id', $id)->first();
        $trip = Trip::where('status', 1)->get();
        $bus_size = BusSize::where('status', 1)->get();
        $bus_no = Bus::where('status', 1)->get();
        $driver= Driver::where('status',1)->get();
        $supervisor = SuperVisor::where('status', 1)->get();
        $client_name = DB::select('select * from clients where id = ?', [$trip[0]->client_id]);
	    $client = Client::where('status', 1)->orderBy('name_en', 'asc')->get();
        return view('admin.pages.tripBus.show', [
            'trip_bus' => $trip_bus,
            'trip' => $trip,
            'bus_no' => $bus_no,
            'bus_size' => $bus_size,
            'driver' => $driver,
	        'client' => $client,
            'supervisor' => $supervisor,
            'client_name' => $client_name
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
        //
        $trip_bus = TripBus::where('id', $id)->first();
        // // return $trip_bus;
        $trip = Trip::where('status', 1)->get();
        // return $trip;
        $bus_size = BusSize::where('status', 1)->get();
        $bus_no = Bus::where('status', 1)->get();
        $driver= Driver::where('status',1)->get();
        $supervisor = SuperVisor::where('status', 1)->get();
        $trip_bus1 = TripBus::where('created_at', '<', date("Y-m-d h:i:s"))->get();
	    $client = Client::where('status', 1)->orderBy('name_en', 'asc')->get();
        $client_name = DB::select('select * from clients where id = ?', [$trip[0]->client_id]);
        $drivers = [];
        for ($i=0; $i < count($driver); $i++) {
            $is_used = true;
            // for ($j=0; $j < count($trip_bus1); $j++) {
            //     if ($trip_bus1[$j]->driver_name == $driver[$i]->id) {
            //         $is_used = false;
            //         break;
            //     }
            // }
            if ($is_used == true) {
                $drivers[] = $driver[$i];
            }
        }

        return view('admin.pages.tripBus.edit', [
            'trip_bus' => $trip_bus,
            'trip' => $trip,
            'bus_no' => $bus_no,
            'bus_size' => $bus_size,
            'driver' => $drivers,
	        'client' => $client,
            'supervisor' => $supervisor,
            'client_name' => $client_name
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
        $content = [
            'trip_name' => $request->trip_name,
            'bus_size' => $request->bus_size,
            'bus_no' => $request->bus_no,
            'driver_name' => $request->driver_name,
            'supervisor_name' => $request->supervisor,
        ];
        $trip_bus = TripBus::where('id', $id)->update($content);

        $trip_bus = TripBus::where('id', $id)->first();
        $supervisor = json_decode($trip_bus->supervisor_name);
        // for ($i = 0; $i < count($supervisor); $i++) {
        //     app('App\Http\Controllers\Admin\SuperVisorController')->sendNotificationToSupervisor($supervisor[$i]);
        // }
        return response()->json(['result' => "success", 'tripdata' => $trip_bus]);
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
    public function status(Request $request)
    {
        TripBus::where('id', $request->id)->update(['status' => toBoolean($request->status)]);
        return response()->json(['result' => "success"]);
    }

    public function tripname(Request $request)
    {

        $bus_not = [];
        $driver_not = [];

        $data = Trip::where('id', $request->trip_id)->first();

        $trip_bus_seleted = TripBus::where('trip_name', $request->trip_id)->get();
        $trip_bus_seleted_freq = [];

        foreach ($trip_bus_seleted as $key => $value) {
            $trip_bus_seleted_freq = json_decode($value->bus_frequancy);
        }

        $trip_freq = json_decode($data->trip_frequancy);
        $trip_bus = TripBus::get();
        // return count($trip_freq);
        if ($trip_freq != null) {
            foreach ($trip_bus as $key => $busvalue) {
                for ($i = 0; $i < count($trip_freq); $i ++) {
                    // dd($busvalue->bus_frequancy);
                    if($busvalue->bus_frequancy == "null") {
                        break;
                    }
                    if (in_array($trip_freq[$i], json_decode($busvalue->bus_frequancy)) == true) {
                        array_push($bus_not, $busvalue->bus_no);
                        array_push($driver_not, $busvalue->driver_name);
                    }
                }
            }
        }
        $bus_result = [];
        $bus_result = $this->checkBus($request->trip_id, $request->busno);
        return response()->json(['result' => "success", 'tripdata' => $data, 'bus_not' => $bus_not, 'driver_not' => $driver_not, 'disableopt' => $trip_bus_seleted_freq, 'bus_result' => $bus_result]);
    }

    public function getbusno($id)
    {
        if ($id == 'undefined') {
            $data = Bus::where([
                        ['status', '=', 1],
                ])->get();
            return response()->json(['data' => $data]);
        }
        $data = Bus::where([
                    ['bus_size_id', '=', $id],
                    ['status', '=', 1],
            ])->get();
        return response()->json(['data' => $data]);
    }

    private function checkBus($trip_id, $bus_id)
    {

        // crashes trips
        $crashes = [];
        // closes trips
        $closes = [];

        $dest_freqs = Trip::where('id', $trip_id)->first();
        $dest_freq = json_decode($dest_freqs->trip_frequancy);

        // trip date
        $start_date =Carbon::parse( $dest_freqs->first_trip_date);
        $end_date = Carbon::parse($dest_freqs->last_trip_date);
        $start_time = $dest_freqs->departure_time;
        $end_time = $dest_freqs->arrival_time;
        $trip_type = $dest_freqs->trip_type;

        //get bus's trip
        $old_trips = TripBus::where('bus_no', $bus_id)
                            ->where('status', '1')
                            ->get();

        if (!is_null($old_trips)) {
            foreach ($old_trips as $key => $value) {
                // get old trip
                $old_trip = Trip::where('id', $value->trip_name)->first();
                $old_start_date = Carbon::parse($old_trip->first_trip_date);
                $old_end_date = Carbon::parse($old_trip->last_trip_date);
                $old_start_time = $old_trip->departure_time;
                $old_end_time = $old_trip->arrival_time;
                $old_trip_type = $old_trip->trip_type;
                if ($trip_type == 0) {
                    if ($old_trip_type == 0) {
                        if ($old_start_date == $start_date) {
                            $closes[] = $old_trip;
                            // time check
                            $time_check = $this->timeCheck($start_time, $end_time, $old_start_time, $old_end_time);
                            if($time_check) $crashes[] = $old_trip;
                        }
                    } else {
                        //date check
                        $date_check = $this->dateCheck($start_date, $end_date, $old_start_date, $old_end_date);
                        if ($date_check) {
                            // day of week check
                            $day_check = $this->dayCheck('['.json_encode(($start_date->dayOfWeek)+1).']',$old_trip->trip_frequancy);
                            if ($day_check) {
                                $closes[] = $old_trip;
                                // time check
                                $time_check = $this->timeCheck($start_time, $end_time, $old_start_time, $old_end_time);
                                if($time_check) $crashes[] = $old_trip;
                            }
                        }
                    }
                } else {
                    if ($old_trip_type == 0) {
                        //date check
                        $date_check = $this->dateCheck($start_date, $end_date, $old_start_date, $old_end_date);
                        if ($date_check) {
                            // day of week check
                            $day_check = $this->dayCheck($dest_freqs->trip_frequancy, '['.json_encode(($old_start_date->dayOfWeek)+1).']');
                            if ($day_check) {
                                $closes[] = $old_trip;
                                // time check
                                $time_check = $this->timeCheck($start_time, $end_time, $old_start_time, $old_end_time);
                                if($time_check) $crashes[] = $old_trip;
                            }
                        }
                    } else {
                        //date check
                        $date_check = $this->dateCheck($start_date, $end_date, $old_start_date, $old_end_date);

                        if ($date_check) {
                            // day of week check
                            $day_check = $this->dayCheck($dest_freqs->trip_frequancy, $old_trip->trip_frequancy);
                            if ($day_check) {
                                $closes[] = $old_trip;
                                // time check
                                $time_check = $this->timeCheck($start_time, $end_time, $old_start_time, $old_end_time);
                                if($time_check) $crashes[] = $old_trip;
                            }
                        }
                    }
                }
            }
        }

        return [
            'closes' => $closes,
            'crashes' => $crashes
        ];
    }

    private function timeCheck($start_time, $end_time, $old_start_time, $old_end_time) {
        $start_time     = Carbon::parse($start_time);
        $end_time       = Carbon::parse($end_time);
        $old_start_time = Carbon::parse($old_start_time);
        $old_end_time   = Carbon::parse($old_end_time);

        if ($start_time->gt($old_start_time) && $old_end_time->gt($end_time)) { // X-O-O-X
            $time_check = true;
        } elseif ($end_time->gt($old_end_time) && $old_end_time->gt($start_time)) { // X-O-X-O
            $time_check = true;
        } elseif ($old_start_time->gt($start_time) && $end_time->gt($old_end_time)) { // O-X-X-O
            $time_check = true;
        } elseif ($end_time->gt($old_start_time) && $old_start_time->gt($start_time)) { // O-X-O-X
            $time_check = true;
        } else {
            $time_check = false;
        }
        return $time_check;
    }

    private function dateCheck($start_date, $end_date, $old_start_date, $old_end_date) {

        if ($start_date->greaterThan($old_start_date) && $old_end_date->greaterThan($end_date)) { // X-O-O-X
            $date_check = true;
        } elseif ($end_date->greaterThan($old_end_date) && $old_end_date->greaterThan($start_date)) { // X-O-X-O
            $date_check = true;
        } elseif ($old_start_date->greaterThan($start_date) && $end_date->greaterThan($old_end_date)) { // O-X-X-O
            $date_check = true;
        } elseif ($end_date->greaterThan($old_start_date) && $old_start_date->greaterThan($start_date)) { // O-X-O-X
            $date_check = true;
        } elseif ($end_date == $old_end_date || $start_date == $old_start_date) {
            $date_check = true;
        }else {
            $date_check = false;
        }

        return $date_check;
    }

    private function dayCheck($trip, $old_trip) {
        $trip = json_decode($trip, true);
        $old_trip = json_decode($old_trip, true);

        $commonValues = array_intersect($trip, $old_trip);
        if(count($commonValues) > 0) return true;
        else return false;
    }
}
