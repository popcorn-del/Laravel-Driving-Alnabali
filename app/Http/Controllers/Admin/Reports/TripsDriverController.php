<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Driver;
use App\Models\DailyTripDetail;
use App\Models\Trip;

class TripsDriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daily_trip = DailyTripDetail::get();
        $driver_data = Driver::get();
        $status = array_fill(0, 8, 0);
        $driver = array_fill(0, ($driver_data[count($driver_data) - 1]->id + 1), $status);

        for ($j=0; $j < count($daily_trip); $j++) {
            $idx = (int)$daily_trip[$j]->driver_id;
            $driver[(int)$idx][(int)$daily_trip[$j]->status]++;
            $driver[$idx][0]++;
            $driver[$idx][7] = $this->getDriverName($driver_data, $idx);
        }
        for ($i=0; $i < ($driver_data[count($driver_data) - 1]->id + 1); $i++) { 
            if ($driver[$i][0] == 0) {
                unset($driver[$i]);
            }
        }
        return view('admin.pages.reports.tripsByDriver.index', [
            'driver_data' => $driver_data,
            'driver' => $driver
        ]);
    }

    public function getDriverName($driver_data, $id){
        for ($i=0; $i < count($driver_data); $i++) {
            if ($driver_data[$i]->id === $id) {
                return $driver_data[$i]->name_en;
            }
        }
        return "";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
