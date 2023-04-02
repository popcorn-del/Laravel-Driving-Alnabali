<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\Driver;
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
            'phone' => 'required|string|min:8|max:9',
        ]);
        $attributeNames = array(
            'status' => 'Status',
            'phone' => 'phone number which you input',
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
        if ($driver == null) return response()->json(['result' => 'Invalid Driver']);

        if ( !(Hash::check($driver_pwd, $driver->password)) ) {
            return response()->json(['result' => 'Invalid Password']);
        } else {
            return response()->json(['result' => 'Login Successfully', 'id' => $driver->id]);
        }
    }

    public function getProfile( $id ) {
        $driver = Driver::findOrFail($id);
        $result = "http://167.86.102.230/alnabali/public/uploads/driver/";
        $result .= $driver->profile_image;
        $driver->profile_image = $result;
        return response()->json(['driver' => $driver]);
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
        $driver->age = $request->birthday;
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

    public function sendNotificationToDriver($id, $messageBody)
    {
        if($id == "" || $id == null) return "null";
       // get a user to get the fcm_token that already sent.               from mobile apps
       $driver = Driver::findOrFail($id);
       $serverkey = env('FCM_SERVER_KEY');

       $return = FCMService::send(
          $driver->fcm_token,
          [
              'title' => 'Alnabali Driver',
              'body' => $messageBody,
              'android_channel_id' => 'channelId'
          ]
       );
       return response()->json(['result' => $driver->fcm_token, 'ddd' => $id, 'sss' => $return, 'ggg' => $serverkey]);
    }
}
