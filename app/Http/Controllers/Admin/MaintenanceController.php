<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Models\Bus;
use App\Models\BusMaintenanceType;
use App\Models\BusMaintenance;

use Carbon\Carbon;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $bus_maintenace = BusMaintenance::get();
        
        $bus_maintenace = BusMaintenance::join('bus_maintenance_types', 'bus_maintenances.maintanence_type_id', '=', 'bus_maintenance_types.id')->select('bus_maintenances.id', 'bus_maintenances.bus_no', 'bus_maintenances.cost', 'bus_maintenances.created_at', 'bus_maintenances.details', 'bus_maintenances.maintanence_date', 'bus_maintenances.maintanence_type_id', 'bus_maintenance_types.status', 'bus_maintenance_types.type_ar', 'bus_maintenance_types.type_en', 'bus_maintenances.updated_at')->orderBy('bus_maintenances.id', 'DESC')
        ->get();
        // return $bus_maintenace;
        return view('admin.pages.maintenance.index', [
            'bus_maintenace' => $bus_maintenace,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bus = Bus::where('status', 1)->get();
        $bus_maintenace_type = BusMaintenanceType::where('status', 1)->get();
        return view('admin.pages.maintenance.create', [
            'bus' => $bus,
            'bus_maintenace_type' => $bus_maintenace_type,
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
        // create
        $bus_maintenace = new BusMaintenance;
        $bus_maintenace->bus_no = $request->bus_no;
        $bus_maintenace->maintanence_type_id = $request->maintenace_type;
        $bus_maintenace->details = $request->details;

        $mydate = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $bus_maintenace->maintanence_date = $mydate;
        
        $bus_maintenace->cost = round($request->cost, 2);
        $bus_maintenace->save();
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
        //
        $bus = Bus::where('status', 1)->get();
        $bus_maintenace_type = BusMaintenanceType::where('status', 1)->get();
        $bus_maintenace = BusMaintenance::where('id', $id)->first();
        return view('admin.pages.maintenance.show', [
            'bus' => $bus,
            'bus_maintenace_type' => $bus_maintenace_type,
            'bus_maintenace' => $bus_maintenace,
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
        $bus = Bus::where('status', 1)->get();
        $bus_maintenace_type = BusMaintenanceType::where('status', 1)->get();
        $bus_maintenace = BusMaintenance::where('id', $id)->first();
        return view('admin.pages.maintenance.edit', [
            'bus' => $bus,
            'bus_maintenace_type' => $bus_maintenace_type,
            'bus_maintenace' => $bus_maintenace,
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
        // update
        $mydate = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $content = [
            'bus_no' => $request->bus_no,
            'maintanence_type_id' => $request->maintenace_type,
            'details' => $request->details,
            'maintanence_date' => $mydate,
            'cost' => $request->cost,
        ];
        $bus_maintenace = BusMaintenance::where('id', $id)->update($content);  
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
}
