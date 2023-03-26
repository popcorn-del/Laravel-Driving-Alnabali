<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Hash;
use App\Models\Driver;
use App\Models\DriverLocation;
use App\Models\DailyTripDetail;
use DB, Validator, Exception, Image, URL;
use Carbon\Carbon;

class DriverLocationController extends Controller
{
    public function add($driver_id) {
        $driver = new DriverLocation;
        $driver->driver_name = $driver_id;
        try {
            $driver->save();
        } catch (Exception $e) {
            return response()->json(['result' => $e->getMessage()]);
        }
    }

    public function updateLocation(Request $request) {
        $driver = null;
        if ( DailyTripDetail::where('id', $request->trip_id)->first() == null) {
            return response()->json(['result' => "Invalid Input Data."]);
        }
        if ($request->trip_id == null) {
            return response()->json(['result' => "Invalid Input Data."]);
        }
        $driver = DriverLocation::where('driver_name', $request->driver_id)->first();
        if ($driver == null) {
            $this->add($request->driver_id);
            $driver = DriverLocation::where('driver_name', $request->driver_id)->first();
        }
        $driver->trip_id = $request->trip_id;
        $driver->latitude = $request->latitude;
        $driver->longitude = $request->longitude;
        $driver->status = true;
        $driver->save();
        return response()->json(['result' => "success"]);
    }

    public function disableStatus(Request $request) {
        DriverLocation::where('driver_name', $request->driver_id)->update(['status' => false]);
        return response()->json(['result' => "success"]);
    }

    public function getDriver() {
        $result = DriverLocation::where('status', true)->get();
        return response()->json(['result' => $result]);
    }
}
