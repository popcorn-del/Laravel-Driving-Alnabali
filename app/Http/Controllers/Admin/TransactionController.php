<?php

namespace App\Http\Controllers;


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Transaction;
use App\Models\Client;
use App\Models\Trip;
use App\Models\City;
use App\Models\Area;
use App\Models\DailyTripDetail;
use App\Models\Bus;
use App\Models\BusSize;
use App\Models\Driver;
use App\Models\SuperVisor;
use App\Models\TripBus;
use App\Models\Notification;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::orderBy('transactions.id', 'DESC')->get();
        $client = Client::where('status', 1)->get();
        $city = City::where('status', 1)->get();
        $bus = Bus::where('status', 1)->get();
        $bus_size = BusSize::where('status', 1)->get();
        $driver = Driver::where('status', 1)->get();
        $trip = Trip::where('status', 1)->get();
        $area = Area::where('status', 1)->get();
        foreach ($transaction as $key => $value) {
            $value->client_name = Client::where('id', $value->client_name)->first()->name_en;
            $daily_trip = DailyTripDetail::where('id', $value->daily_trip_id)->get();
            if (count($daily_trip) > 0) {
                $value->origin_city = $daily_trip[0]->origin_city;
                $value->origin_area = $daily_trip[0]->origin_area;
                $value->destination_city = $daily_trip[0]->destination_city;
                $value->destination_area = $daily_trip[0]->destination_area;
            }
        }
        //
        return view('admin.pages.transaction.index', [
            'transaction' => $transaction,
            'client' => $client,
            'city' => $city,
            'bus' => $bus,
            'area' => $area,
            'bus_size' => $bus_size,
            'driver' => $driver,
            'trip' => $trip,
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
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        $client = Client::findOrFail($transaction->client_name);
        $trip = Trip::findOrFail($transaction->trip_id);
        $origin_city = City::findOrFail($trip->origin_city);
        $destination_city = City::findOrFail($trip->destination_city);
        $origin_area = Area::findOrFail($trip->origin_area);
        $destination_area = Area::findOrFail($trip->destination_area);
        $bus = Bus::findOrFail($transaction->bus_id);
        $bus_size = BusSize::findOrFail($bus->bus_size_id);

        //
        return view('admin.pages.transaction.show', [
            'transaction' => $transaction,
            'client_name' => $client->name_en,
            'trip' => $trip,
            'origin_city' => $origin_city->city_name_en,
            'destination_city' => $destination_city->city_name_en,
            'origin_area' => $origin_area->area_name_en,
            'destination_area' => $destination_area->area_name_en,
            'bus_no' => $bus->bus_no,
            'bus_size' => $bus_size->size,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function getTransaction($id) {
        $transactions = Transaction::where('trip_id', $id)->orderBy('transactions.id', 'ASC')->get();
        return response()->json(['result' => $transactions]);
    }
}
