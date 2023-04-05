<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;
use App\Models\Bus;
use App\Models\BusSize;
use App\Models\Trip;
use App\Models\Driver;
use App\Models\TripBus;
use App\Models\SuperVisor;

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
    public function create()
    {
        $trip = Trip::where('status', 1)->get();
        $bus_size = BusSize::where('status', 1)->get();
        $bus_no = Bus::where('status', 1)->get();
        $driver= Driver::where('status',1)->get();
        $supervisor = SuperVisor::where('status', 1)->get();
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
            'bus_no' => $bus_no,
            'driver' => $driver,
            'supervisor' => $supervisor,
            'lang'=>$lang
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

        return view('admin.pages.tripBus.show', [
            'trip_bus' => $trip_bus,
            'trip' => $trip,
            'bus_no' => $bus_no,
            'bus_size' => $bus_size,
            'driver' => $driver,
            'supervisor' => $supervisor,
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
        $trip_bus = TripBus::where('id', $id)->first();
        // return $trip_bus;
        $trip = Trip::where('status', 1)->get();
        // return $trip;
        $bus_size = BusSize::where('status', 1)->get();
        $bus_no = Bus::where('status', 1)->get();
        $driver= Driver::where('status',1)->get();
        $supervisor = SuperVisor::where('status', 1)->get();
        $trip_bus1 = TripBus::where('created_at', '<', date("Y-m-d h:i:s"))->get();
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
            'supervisor' => $supervisor,
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
        for ($i = 0; $i < count($supervisor); $i++) {
            app('App\Http\Controllers\Admin\SuperVisorController')->sendNotificationToSupervisor($supervisor[$i]);
        }
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

        $data = Trip::where('id', $request->id)->first();

        $trip_bus_seleted = TripBus::where('trip_name', $request->id)->get();
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
        return response()->json(['result' => "success", 'tripdata' => $data, 'bus_not' => $bus_not, 'driver_not' => $driver_not, 'disableopt' => $trip_bus_seleted_freq]);
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
}
