<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\DailyTripDetail;
use App\Models\Trip;

class TripsClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = DailyTripDetail::get();
        $c = Client::get();
        $status = array();
        $status = array_fill(0, 8, 0);
        $client = array_fill(0, ($c[count($c) - 1]->id + 1), $status);

        for ($j=0; $j < count($response); $j++) {
            $idx = (int)$response[$j]->client_name;
            $client[$idx][$response[$j]->status]++;
            $client[$idx][0]++;
        }

        for ($i=0; $i < ($c[count($c) - 1]->id + 1); $i++) { 
            if ($client[$i][0] == 0) {
                unset($client[$i]);
            }
        }
        $client_data = Client::get();
        foreach ($client as $key => $value) {
            $cc = Client::where('id', $key)->get();
            $client[$key][7] = $cc[0]->name_en;
        }
        // return $client;
        return view('admin.pages.reports.tripsByClient.index', [
            'client_data' => $client_data,
            'client' => $client
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
