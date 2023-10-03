<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BusSize;
use App\Models\DailyTripDetail;
use App\Models\Trip;

class TripsBusSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daily_trip = DailyTripDetail::get();
        $bussize_data = BusSize::get();
        $status = array_fill(0, 9, 0);
        $response = array_fill(0, ($bussize_data[count($bussize_data) - 1]->id + 1), $status);
        for ($j=0; $j < count($daily_trip); $j++) {
            $idx = (int)$daily_trip[$j]->f_bus_size_id;
            $response[(int)$idx][(int)$daily_trip[$j]->status]++;
            $response[$idx][0]++;
            $response[$idx][8] = $bussize_data[$idx-1]->size;
        }
        for ($i=0; $i < ($bussize_data[count($bussize_data) - 1]->id + 1); $i++) {
            if ($response[$i][0] == 0) {
                unset($response[$i]);
            }
        }
        return view('admin.pages.reports.tripsByBusSize.index', [
            'bussize_data' => $bussize_data,
            'response' => $response
        ]);
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
