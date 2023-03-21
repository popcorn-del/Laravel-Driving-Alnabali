<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;
use App\Models\Client;
use App\Models\City;
use App\Models\Trip;
use App\Models\Area;

use Carbon\Carbon;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trip = Trip::leftJoin('clients as c', 'c.id' , '=','trips.client_id')
                  ->leftJoin('cities as c1',  'c1.id','=','trips.origin_city')
                  ->leftJoin('cities as c2', 'c2.id','=','trips.destination_city')
                  ->leftJoin('areas as a1','a1.id','=','trips.origin_area')
                  ->leftJoin('areas as a2','a2.id','=','trips.destination_area')
                  ->select('trips.*', 'c.name_en as client_name', 'c1.city_name_en as origin_city_name_en','c2.city_name_en as destination_city_name_en','a1.area_name_en as origin_area_name_en' , 'a2.area_name_en as destination_area_name_en')->orderBy('trips.id', 'DESC')
                  ->get();
        return view('admin.pages.trip.index', [
            "trip" => $trip,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = Client::get();
        $city = City::where('status', 1)->get();
        return view('admin.pages.trip.create', [
            'client' => $client,
            'city' => $city,           
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
         /**
         * check the status validate.
         */ 
        $validator = Validator::make($request->all(), [
          
            'trip_type' => 'required',
         //   'trip_frequency.*'=> 'required | array' ,            
            // 'show_trip_admin' => 'required',
            'status' => 'required',

        ]);
        $attributeNames = array(
            'trip_type' => 'Trip Type',
         //   'trip_frequency'=> 'Trip Frequency',            
            // 'show_trip_admin' => 'Show Admin',
            'status' => 'Status',
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
            
            $trip = Trip::findOrFail($request->id);
        } else {    
            $exist_data = Trip::where('trip_name_en', $request->name_en)->get();
            if(count($exist_data) > 0){
                return response()->json(['result' => "exist"]);    
            } 
            $trip = new Trip;
        }
        $trip->trip_name_en = $request->name_en;
        $trip->trip_name_ar = $request->name_ar;
        $trip->client_id = $request->client;
        $trip->trip_type = $request->trip_type;
        $trip->details = $request->details;
        $trip->trip_frequancy = json_encode($request->trip_frequancy);

        $myfdate = Carbon::createFromFormat('d/m/Y', $request->first_trip_date)->format('Y-m-d');
        $trip->first_trip_date = $myfdate;
        
        $myldate = Carbon::createFromFormat('d/m/Y', $request->last_trip_date)->format('Y-m-d');
        $trip->last_trip_date = $myldate;
        
        $trip->origin_city = $request->origin_city;
        $trip->origin_area = $request->origin_area;
        $trip->destination_city = $request->destination_city;
        $trip->destination_area = $request->destination_area;
        $trip->departure_time = $request->departure_time;
        $trip->arrival_time = $request->arrival_time;
        $trip->status = $request->status;
        $trip->save();
        return response()->json(['result' => "success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        // $data = Area::where('city_id', $id)->where('status', 1)->get();
        // return response()->json(['data' => $data]);
        $trip = Trip::where('id', $id)->first();
        // dd(in_array("5", (json_decode($trip->trip_frequancy))));
        $client = Client::get();
        $city = City::where('status', 1)->get();
        $area = Area::where('status',1)->get();

        return view('admin.pages.trip.show', [
            'trip' => $trip,
            'client' => $client,
            'city' => $city,
            'area' => $area,            
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
        $trip = Trip::where('id', $id)->first();
        // dd(in_array("5", (json_decode($trip->trip_frequancy))));
        $client = Client::get();
        $city = City::where('status', 1)->get();
        $area = Area::where('status',1)->get();

        return view('admin.pages.trip.edit', [
            'trip' => $trip,
            'client' => $client,
            'city' => $city,
            'area' => $area,            
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
        Trip::where('id', $request->id)->update(['status' => toBoolean($request->status)]);
        return response()->json(['result' => "success"]);
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
        Trip::where('id', $request->id)->update(['status' => toBoolean($request->status)]);
        return response()->json(['result' => "success"]);
    }

    public function getArea($id) {
        if ($id == 'undefined') {
            $data = Area::where('status', 1)->get();
            return response()->json(['data' => $data]);
        }
        $data = Area::where('city_id', $id)->where('status', 1)->get();
        return response()->json(['data' => $data]);
    }
}
