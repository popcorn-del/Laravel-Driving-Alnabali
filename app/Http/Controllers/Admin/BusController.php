<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;
use App\Models\Bus;
use App\Models\BusSize;
use App\Models\BusType;
use App\Models\BusModel;
use App\Models\TripBus;

use Carbon\Carbon;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bus = Bus::leftJoin('bus_types', 'buses.bus_type_id', '=', 'bus_types.id')
                  ->leftJoin('bus_models', 'buses.bus_model_id', '=', 'bus_models.id')
                  ->leftJoin('bus_sizes', 'buses.bus_size_id', '=', 'bus_sizes.id')
                  ->select('buses.*', 'bus_types.type_en','bus_types.type_ar', 'bus_models.model_en', 'bus_models.model_ar','bus_sizes.size')
                  ->orderBy('buses.id', 'DESC')->get();
        $lang=app()->getLocale();
        return view('admin.pages.bus.index', [
            "bus" => $bus,
            "lang" => $lang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bus_size = BusSize::where('status', 1)->get();
        $bus_type = BusType::where('status', 1)->orderby('type_en','asc')->get();
        $bus_model = BusModel::where('status', 1)->orderby('model_en','asc')->get();
        $model_year = [];
        for ($i=date('Y'); $i >= 1950 ; $i--) {
            array_push($model_year, $i);
        }
        return view('admin.pages.bus.create', [
            'bus_type' => $bus_type,
            'bus_model' => $bus_model,
            'bus_size' => $bus_size,
            'model_year' => $model_year,
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
        $exist_data = Bus::where('bus_no', $request->bus_no)->get();
        if(count($exist_data) > 0){
            return response()->json(['result' => "exist"]);
        } else {
            // if($bus->id){
            //     $bus = Bus::findOrFail($request->id);
            // } else {
            //     $bus = new Bus;
            // }
            $bus = new Bus;
            $bus->bus_no = $request->bus_no;
            $bus->bus_size_id = $request->bus_size;
            $bus->license_no = $request->license_number;

            $expirydate = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
            $bus->license_expiry_date = $expirydate;

            $bus->bus_type_id = $request->bus_type;
            $bus->bus_model_id = $request->bus_model;
            $bus->model_year = $request->model_year;
            $bus->status = $request->status;
            $bus->owner_ship = $request->ownership;
            $bus->save();
            return response()->json(['result' => "success"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data = BusModel::where('bus_type_id', $id)->where('status', 1)->get();
        // return response()->json(['data' => $data]);
        $bus = Bus::leftJoin('bus_models', 'buses.bus_model_id', '=', 'bus_models.id')->where('buses.id', $id)->select('buses.*', 'bus_models.model_en')->first();
        $bus_size = BusSize::where('status', 1)->get();
        $bus_type = BusType::where('status', 1)->get();
        $bus_model = BusModel::where('status', 1)->get();
        $model_year = [];
        for ($i=date('Y'); $i >= 1950 ; $i--) {
            array_push($model_year, $i);
        }
        return view('admin.pages.bus.show', [
            'bus' => $bus,
            'bus_type' => $bus_type,
            'bus_model' => $bus_model,
            'bus_size' => $bus_size,
            'model_year' => $model_year,
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
        $bus = Bus::leftJoin('bus_models', 'buses.bus_model_id', '=', 'bus_models.id')->where('buses.id', $id)->select('buses.*', 'bus_models.model_en')->first();
        $bus_size = BusSize::where('status', 1)->get();
        $bus_type = BusType::where('status', 1)->orderby('type_en','asc')->get();
        $bus_model = BusModel::where('status', 1)->orderby('model_en','asc')->get();
        $bus_selected_model = BusModel::where('status', 1)->where('id', $bus->bus_model_id)->orderby('model_en','asc')->get()->first();
        $bus_type1 = BusType::where('status', 1)->where('id', $bus_selected_model->bus_type_id)->get()->first();
        $bus_selected_models = BusModel::where('status', 1)->where('bus_type_id', $bus_type1->id)->get();
        $model_year = [];
        for ($i=date('Y'); $i >= 1950 ; $i--) {
            array_push($model_year, $i);
        }
        return view('admin.pages.bus.edit', [
            'bus' => $bus,
            'bus_type' => $bus_type,
            'bus_model' => $bus_model,
            'bus_selected_models' => $bus_selected_models,
            'bus_size' => $bus_size,
            'model_year' => $model_year,
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
        if ($request->is_set_status) {
            return $this->status($request);;
        }
        $mydate = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $content = [
            'bus_no' => $request->bus_no,
            'bus_size_id' => $request->bus_size,
            'license_no' => $request->license_number,

            'license_expiry_date' => $mydate,

            'bus_type_id' => $request->bus_type,
            'bus_model_id' => $request->bus_model,
            'model_year' => $request->model_year,
            'status' => $request->status,
            'owner_ship' => $request->ownership,
        ];

        $bus = Bus::where('id', $id)->update($content);
        
        if($request->status == 0){
            TripBus::setInactive('bus_no',$id);
        }
            
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
        Bus::where('id', $request->id)->update(['status' => toBoolean($request->status)]);
        if($request->status == 0){
            TripBus::setInactive('bus_no',$request->id);
        }
        return response()->json(['result' => "success"]);
    }

    public function getBuses(Request $request) {
        $buses = Bus::all();
        return response()->json(['result' => $buses]);
    }
    
    public function getModel($id) {
        $data = BusModel::where('bus_type_id', $id)->where('status', 1)->orderby('model_en','asc')->get();
        return response()->json(['data' => $data]);
    }

    public function getModelAll() {
        $data = BusModel::where('status', 1)->orderby('model_en','asc')->get();
        return response()->json(['data' => $data]);
    }
}
