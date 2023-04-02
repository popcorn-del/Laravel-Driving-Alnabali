<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Trip;
use App\Models\TripBus;
use App\Models\Client;
use App\Models\DailyTripDetail;


class TripsBusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = DailyTripDetail::get();
        $b = Bus::get();
        $status = array();
        $status = array_fill(0, 9, 0);
        $bus = array_fill(0, ($b[count($b) - 1]->id + 1), $status);

        for ($j=0; $j < count($response); $j++) {
            $idx = (int)$response[$j]->f_bus_id;
            $bus[$idx][$response[$j]->status]++;
            $bus[$idx][0]++;
        }
        for ($i=0; $i < ($b[count($b) - 1]->id + 1); $i++) {
            if ($bus[$i][0] == 0) {
                unset($bus[$i]);
            }
        }
        foreach ($bus as $key => $value) {
            $cc = Bus::where('id', $key)->get();
            $bus[$key][8] = $cc[0]->bus_no;
        }
        $bus_data = Bus::get();
        return view('admin.pages.reports.tripsByBus.index',[
            'bus_data' => $bus_data,
            'bus' => $bus
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
