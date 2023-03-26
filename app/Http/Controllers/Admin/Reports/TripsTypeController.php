<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyTripDetail;
use App\Models\Trip;

class TripsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = DailyTripDetail::where('trip_type', 1)->get();
        $inactive = DailyTripDetail::where('trip_type', 0)->get();
        $status1 = array_fill(0, 8, 0);
        $status2 = array_fill(0, 8, 0);

        for ($i=0; $i < count($active); $i++) {
            $status1[$active[$i]->status] ++;
            $status1[0] ++;
        }
        $status1[7] = "NON-PERIODIC";
        $status2[7] = "PERIODIC";
        for ($i=0; $i < count($inactive); $i++) {
            $status2[$inactive[$i]->status] ++;
            $status2[0] ++;
        }
        return view('admin.pages.reports.tripsByType.index', [
            'tbl' => array($status1, $status2)
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
