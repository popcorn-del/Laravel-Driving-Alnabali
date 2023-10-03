<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\Driver;
use App\Models\DailyTripDetail;
use App\Models\Trip;
use App\Models\DateTime;
use DB, Validator, Exception, Image, URL;
use Carbon\Carbon;

use App\Services\FCMService;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driver = Driver::orderBy('drivers.id', 'DESC')->get();
        return view('admin.pages.driver.index', [
            'driver' => $driver,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.driver.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'user_name'   => 'required|string|unique:drivers,user_name',
        ],[
            'status.required' => 'The status field is required.',
            'user_name.required' => 'The user name field is required.',
            'user_name.string' => 'The user name must be a string.',
            'user_name.unique' => 'The user name has already been taken.',
        ]);
        
        $attributeNames = array(
            'status' => 'Status',
        );
        $validator->setAttributeNames($attributeNames);
        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        } else {
            if($request->id){
                $driver = Driver::findOrFail($request->id);
            } else {
                $driver = new Driver;
                $driver->password = Hash::make($request->password);
            }
            $driver->name_en = $request->name_en;
            // $driver->name_ar = $request->name_ar;
            $driver->name_ar = $request->user_name;
            // $driver->user_email = $request->user_email;

            $myage = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
            $driver->age = $myage;

            $driver->phone = $request->phone;
            $driver->license_number = $request->license_number;
            $driver->address = $request->address;
            $driver->user_name = $request->user_name;

            $myexpiredate = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
            $driver->license_expiry_date = $myexpiredate;

            $driver->status = $request->status;
            if ($request->has('file')) {
                $path = public_path('uploads/driver/');
                if(!file_exists($path)){
                    File::makeDirectory($path);
                }
                $file = $request->file;
                $fileName = time().'_'.$file->getClientOriginalName();
                $imgx = Image::make($file->getRealPath());
                $imgx->resize(150, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path.$fileName);
                $driver->profile_image = $fileName;
            } else {
                $driver->profile_image = "";
            }
            $driver->save();
            return response()->json(['result' => 'success']);
        }
    }

    public function status(Request $request)
    {
        // return $request;
        Driver::where('id', $request->id)->update(['status' => toBoolean($request->status)]);
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
        $driver = Driver::findOrFail($id);
        return view('admin.pages.driver.show', [
            'driver' => $driver,
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
        $driver = Driver::findOrFail($id);
        return view('admin.pages.driver.edit', [
            'driver' => $driver,
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
        if ($request->status) {
            return $this->status($request);;
        }
        // Driver::where('id', $request->id)->update(['status' => toBoolean($request->status)]);
        $driver = Driver::where('id', $id)->update(['password' => Hash::make($request->password)]);
        return response()->json(['result' => 'success']);
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

    public function getToken() {
        return response()->json(['token' => csrf_token()]);
    }

    public function driverLogin(Request $request) {
        $driver_name = $request->get('email');
        $driver_pwd = $request->get('password');

        $driver =  Driver::where('user_name', $driver_name)->first();
        if($driver == null) $driver =  Driver::where('name_en', $driver_name)->first();
            if ($driver == null) return response()->json(['result' => 'Invalid Driver']);

        if ( !(Hash::check($driver_pwd, $driver->password)) ) {
            return response()->json(['result' => 'Invalid Password']);
        } else {
            return response()->json(['result' => 'Login Successfully', 'id' => $driver->id, 'date' => DateTime::getDateTime()['date']]);
        }
    }

    public function getProfile( $id ) {
        $driver = Driver::findOrFail($id);
        $result = "http://213.136.71.7/alnabali/public/uploads/driver/";
        $result .= $driver->profile_image;
        $driver->profile_image = $result;
        $total = $this->getTripData($id);
        $driver->workingHours = $total['workingHours'];
        $driver->totalTrips = $total['totalTrips'];
        $driver->totalDistance = $total['totalDistance'];

        return response()->json(['driver' => $driver]);
    }

    private function getTripData($id) {
        $diff = 0;
        $total_trips = 0;
        $totalDistance = 0;
        $driver_name = Driver::where('id', $id)->first()->name_en;
        $daily_trips = DailyTripDetail::where('dirver_name', $driver_name)->where('status', 6)->orderBy('start_date','desc')->get();  
        $result['workingHours'] = $diff;
        $result['totalTrips'] = $total_trips;
        $result['totalDistance'] = $totalDistance;

        if(count($daily_trips) >= 1){
            foreach ($daily_trips as $key => $value) {
                $trip = Trip::where('id', $value->f_trip_id)->first();
                $start = Carbon::parse($trip->departure_time);
                $end = Carbon::parse($trip->arrival_time);
                $duration = $end->diffInMinutes($start, true);
                $diff += $duration;      
                $total_trips++;                                  
            }
            $result['workingHours'] = round($diff/60,1);
            $result['totalTrips'] = $total_trips;
            $result['totalDistance'] = round($result['workingHours'] * 36,1);
        }
        
        return $result;
    }

    public function editProfile(Request $request) {
        $id = $request->get('id');
        $driver =  Driver::where('id', $id)->first();
        // return response()->json(['driver' => $driver]);

        if (!$driver) return response()->json(['result' => 'Invalid User']);
        if ($request->name == "" || $request->birthday == "" || $request->phone == "" || $request->address == "") {
            return response()->json(['result' => 'Invalid input data']);
        }

        $driver->name_en = $request->name;
        $myage = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        $driver->age = $myage;
        
        $driver->phone = $request->phone;
        $driver->address = $request->address;
        try {
            $driver->save();
        } catch (Exception $e) {
            return response()->json(['result' => $e->getMessage()]);
        }

        return response()->json(['result' => 'Update successfully']);
    }

    public function changePassword(Request $request) {
        $id = $request->get('id');
        $driver =  Driver::where('id', $id)->first();
        if (!$driver) return response()->json(['result' => 'Invalid User']);

        $current_pwd = $request->get('current_pwd');
        $new_pwd = $request->get('new_pwd');

        if ($current_pwd == "" || $new_pwd == "") {
            return response()->json(['result' => 'Invalid input data']);
        }

        if ( !(Hash::check($current_pwd, $driver->password)) ) {
            return response()->json(['result' => 'Invalid Password']);
        } else {
            $driver->password = Hash::make($new_pwd);
            $driver->save();
            return response()->json(['result' => 'Changed successfully']);
        }
    }

    public function getDrivers(Request $request) {
        $drivers =  Driver::all();
        return response()->json(['result' => $drivers]);
    }

    public function saveFCMToken(Request $request) {
        $driver = Driver::findOrFail($request->id);
        $driver->fcm_token = $request->fcm_token;
        $driver->save();
        return response()->json(['result' => 'success']);
    }

    public function sendNotificationToDriver($id, $messageBody,$trip_id=0)
    {
        if($id == "" || $id == null) return "null";
       // get a user to get the fcm_token that already sent.               from mobile apps
       $driver = Driver::findOrFail($id);
       $serverkey = env('FCM_SERVER_KEY');

       $return = FCMService::send(
          $driver->fcm_token,
          [
              'title' => 'Alnabali Driver',
              'body' => $messageBody."::::".$trip_id,
              'android_channel_id' => 'channelId'
          ]
       );
       return response()->json(['result' => $driver->fcm_token, 'ddd' => $id, 'sss' => $return, 'ggg' => $serverkey]);
    }

    public function uploadImage(Request $request) {
        $image = $_POST['image'];
        $name = $_POST['name'];
    
        $realImage = base64_decode($image);
        if($request->id){
            $driver = Driver::findOrFail($request->id);
            if ($realImage) {
                $path = public_path('uploads/driver/');
                if(!file_exists($path)){
                    File::makeDirectory($path);
                }
                $file = $realImage;
                $fileName = time().'_'.$name;
                // $imgx = Image::make($file->getRealPath());
                // $imgx->resize(150, null, function ($constraint) {
                //     $constraint->aspectRatio();
                // })->save($path.$fileName);

                file_put_contents($path.$fileName, $realImage);
 
                $driver->profile_image = $fileName;
                $driver->save();
                return response()->json(['result' => $fileName]);
            }    
        } else {
            return response()->json(['result' => 'error']);
        }
    }

    public function removeImage(Request $request) {
    
        if($request->id){
            $driver = Driver::findOrFail($request->id);
            $driver->profile_image = NULL;
            $driver->save();
            return response()->json(['result' => $driver->profile_image]);    
        } else {
            return response()->json(['result' => 'error']);
        }
    }

      public  function getDetailInfo(Request $request) {
	$data = DB::select("select * from daily_trip_details where id = ?", array($request['tripID']));
                 return response()->json(['result' => $data[0]]);   
	}
}
