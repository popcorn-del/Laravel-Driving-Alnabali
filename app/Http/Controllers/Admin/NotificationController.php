<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Client;
use App\Models\SuperVisor;
use App\Models\Driver;
use App\Models\Trip;
use App\Models\City;
use App\Models\Area;
use App\Models\Bus;
use App\Models\BusSize;
use App\Models\TripBus;
use App\Models\DailyTripDetail;
use App\Models\Transaction;

use Illuminate\Http\Request;
use Carbon\Carbon;


class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $notification = Notification::orderBy('notifications.id', 'DESC')->get();
        $client = Client::where('status', 1)->get();
        $city = City::where('status', 1)->get();
        $bus = Bus::where('status', 1)->get();
        $bus_size = BusSize::where('status', 1)->get();
        $drivers = Driver::where('status', 1)->get();
        $trip = Trip::where('status', 1)->get();
        $area = Area::where('status', 1)->get();
        foreach ($notification as $key => $value) {
            if (is_numeric($value->receiver)) {
                $driver = Driver::where('id', $value->receiver)->first();
                $value->receiver = $driver->name_en;
            }
            $value->client_name = Client::where('id', $value->client_name)->first()->name_en;
            $daily_trip = DailyTripDetail::where('id', $value->daily_trip_id)->get();
            if (count($daily_trip) > 0) {
                $value->origin_city = $daily_trip[0]->origin_city;
                $value->origin_area = $daily_trip[0]->origin_area;
                $value->destination_city = $daily_trip[0]->destination_city;
                $value->destination_area = $daily_trip[0]->destination_area;
            }
        }
        return view('admin.pages.notification.index', [
            'notification' => $notification,
            'client' => $client,
            'city' => $city,
            'bus' => $bus,
            'area' => $area,
            'bus_size' => $bus_size,
            'driver' => $drivers,
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
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $notification = Notification::findOrFail($id);
        if (is_numeric($notification->receiver)) {
            $driver = Driver::where('id', $notification->receiver)->first();
            $notification->receiver = $driver->name_en;
        }
        $client = Client::findOrFail($notification->client_name);
        $trip = Trip::findOrFail($notification->trip_id);
        $origin_city = City::findOrFail($trip->origin_city);
        $destination_city = City::findOrFail($trip->destination_city);
        $origin_area = Area::findOrFail($trip->origin_area);
        $destination_area = Area::findOrFail($trip->destination_area);

        $tripbus = TripBus::where('trip_name', $notification->trip_id)->get();
        $bus_size = BusSize::where('id', $tripbus[0]->bus_size)->first();
        $bus = Bus::where('id', $tripbus[0]->bus_no)->first();
        //
        return view('admin.pages.notification.show', [
            'notification' => $notification,
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
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }

    public function getTodayNotification() {

        $return_val = [];
        $today = Carbon::now()->format('m-d-Y');

        $today_year = Carbon::now()->format('y');
        $today_month = Carbon::now()->format('m');
        $today_date = Carbon::now()->format('d');

        $notifications = Notification::orderBy('created_at', 'DESC')->get();
        foreach ($notifications as $notification) {
            $trip_month = $notification->updated_at->format('m');
            $trip_date = $notification->updated_at->format('d');

            if ($today_month == $trip_month && $today_date == $trip_date) {
                if (!is_numeric($notification->receiver)) {
                    array_push($return_val, $notification);
                }

                $client = Client::findOrFail($notification->client_name);
                $result = "http://167.86.102.230/alnabali/public/uploads/image/";
                $result .= $client->client_avatar;
                $notification->client_avatar = $result;
            }
        }

        return response()->json(['result' => $return_val, 'today' => $today]);
    }

    public function getAllNotification($id) {
        $return_val = [];
        $today = Carbon::now()->format('m-d-Y');
        $notifications = Notification::where('receiver', $id)->orderBy('created_at', 'DESC')->get();
        foreach ($notifications as $notification) {
            $client = Client::findOrFail($notification->client_name);
            $result = "http://167.86.102.230/alnabali/public/uploads/image/";
            $result .= $client->client_avatar;
            $notification->client_avatar = $result;
            $notification->viewed=$notification->read_at?true:false;
        }

        return response()->json(['result' => $notifications, 'today' => $today]);

        // $notifications = Notification::all();
        // foreach ($notifications as $notification) {
        //     $client = Client::findOrFail($notification->client_name);
        //     $result = "http://167.86.102.230/alnabali/public/uploads/image/";
        //     $result .= $client->client_avatar;
        //     $notification->client_avatar = $result;
        // }

        // return response()->json(['result' => $notifications]);
    }

    public function markAsRead($id){
        $notification=Notification::findOrFail($id);
        $notification->read_at=now();
        $notification->save();
        return response()->json(['success'=>true,'message'=>'notification marked as read']);
    }

    public static function saveDriverNotification($dailyTripDetail, $driver_id, $message) {
        $notification = new Notification;
        $notification->client_name = $dailyTripDetail->client_name;
        $notification->destination_name = $dailyTripDetail->destination_city;
        $notification->origin_name = $dailyTripDetail->origin_city;
        $notification->driver_name = $dailyTripDetail->dirver_name;
        $notification->message = $message;
        $notification->status = $dailyTripDetail->status;
        $notification->trip_id = $dailyTripDetail->f_trip_id;
        $notification->trip_name = $dailyTripDetail->trip_name;
        $notification->disp_trip_id = $dailyTripDetail->trip_id;
        $notification->daily_trip_id = $dailyTripDetail->id;
        $notification->receiver = $dailyTripDetail->driver_id;
        $notification->receive_app = 1;
        app('App\Http\Controllers\Admin\DriverController')->sendNotificationToDriver($driver_id, $message);
        $notification->save();
        return "success";
    }

    public static function saveSupervisorNotification($dailyTripDetail, $supervisor_id, $message) {
        $notification = new Notification;
        $notification->client_name = $dailyTripDetail->client_name;
        $notification->destination_name = $dailyTripDetail->destination_city;
        $notification->origin_name = $dailyTripDetail->origin_city;
        $notification->driver_name = $dailyTripDetail->dirver_name;
        $notification->message = $message;
        $notification->status = $dailyTripDetail->status;
        $notification->trip_id = $dailyTripDetail->f_trip_id;
        $notification->trip_name = $dailyTripDetail->trip_name;
        $notification->daily_trip_id = $dailyTripDetail->id;
        $notification->disp_trip_id = $dailyTripDetail->trip_id;
        $notification->receive_app = 0;

        $supervisor_name = SuperVisor::where('id', $supervisor_id)->first()->name;
        $notification->receiver = $supervisor_name;
        app('App\Http\Controllers\Admin\SuperVisorController')->sendNotificationToSupervisor($supervisor_id, $message);
        $notification->save();
        return "success";
    }


    public function sendNotification(Request $request)
    {
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = env('FCM_SERVER_KEY');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return back()->with('success', 'Notification send successfully.');
    }
}
