<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use App\Models\SuperVisor;
use DB, Validator, Exception, Image, URL;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;
use App\Services\FCMService;

class SuperVisorController extends Controller
{

    private $save_path = "";
    private $image_string = '';
    private $image_name = '';
    private $image;

    public $loaded = false;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    // public function __construct() {
    //     $this->middleware('auth');
    // }
    
    public function index()
    {
        $super_visor = SuperVisor::orderBy('super_visors.id', 'DESC')->get();
        return view('admin.pages.supervisor.index', [
            'supervisor' => $super_visor,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.supervisor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if($request->id){
            $supervisor = SuperVisor::findOrFail($request->id);
            $username = $supervisor->name;
        } else {
            $validator = Validator::make($request->all(), [
                'status' => 'required',
            
                'phone' => 'required | unique:super_visors',
          
                'user_name'=>'required | unique:super_visors',
                // 'file' => 'required'
             
    
    
            ]);
            $attributeNames = array(
                'status' => 'Status',           
                'phone' => 'Phone Number',            
                'user_name'=>'User Name',
                // 'file'=> 'Profile image'
                
                
    
            );
            $validator->setAttributeNames($attributeNames);
            if($validator->fails()) {
                return response()->json(['error'=>$validator->errors()->all()]);
            }
            $supervisor = new SuperVisor;
            $supervisor->password = Hash::make($request->password);
        }

        if ($request->name_en == null) {
            $supervisor->name = $username;
        } else {
            $supervisor->name = $request->name_en;
        }
        $supervisor->phone = $request->phone;
        $supervisor->address = $request->address;
        $supervisor->user_name = $request->user_name;

        $mybirth = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        $supervisor->birthday = $mybirth;
        
        $supervisor->status = $request->status;
        if ($request->has('file')) {
            $path = public_path('uploads/supervisor/');
            if(!file_exists($path)){
                File::makeDirectory($path);
            }
            $file = $request->file;
            $fileName = time().'_'.$file->getClientOriginalName();
            $imgx = Image::make($file->getRealPath());
            $imgx->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path.$fileName);
            $supervisor->profile_image = $fileName;
        } else {
            $supervisor->profile_image = null;
        }
        $supervisor->save();
        return response()->json(['result' => 'success']);
        
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
        $supervisor = SuperVisor::findOrFail($id);
        return view('admin.pages.supervisor.show', [
            'supervisor' => $supervisor,
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
        $supervisor = SuperVisor::findOrFail($id);
        return view('admin.pages.supervisor.edit', [
            'supervisor' => $supervisor,
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
        $supervisor = SuperVisor::where('id', $id)->update(['password' => Hash::make($request->password)]);
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

    public function status(Request $request)
    {
        SuperVisor::where('id', $request->id)->update(['status' => toBoolean($request->status)]);
        return response()->json(['result' => "success"]);
    }


    public function driverLogin(Request $request) {
        $driver_name = $request->get('email');
        $driver_pwd = $request->get('password');

        $driver =  SuperVisor::where('user_name', $driver_name)->first();
        if ($driver == null) return response()->json(['result' => 'Invalid SuperVisor']);

        if ( !(Hash::check($driver_pwd, $driver->password)) ) {
            return response()->json(['result' => 'Invalid Password']);
        } else {
            return response()->json(['result' => 'Login Successfully', 'id' => $driver->id]);
        }
    }

    public function getProfile( $id ) {
        $driver = SuperVisor::findOrFail($id);
        return response()->json(['driver' => $driver]);
    }

    public function editProfile(Request $request) {
        $id = $request->get('id');
        $driver =  SuperVisor::where('id', $id)->first();
        // return response()->json(['driver' => $driver]);

        if (!$driver) return response()->json(['result' => 'Invalid User']);
        if ($request->name == "" || $request->birthday == "" || $request->phone == "" || $request->address == "") {
            return response()->json(['result' => 'Invalid input data']);
        }
        
        $driver->name = $request->name;
        $driver->birthday = $request->birthday;
        $driver->phone = $request->phone;
        $driver->address = $request->address;
        $driver->save();

        return response()->json(['result' => 'success']);
    }

    public function changePassword(Request $request) {
        $id = $request->get('id');
        $driver =  SuperVisor::where('id', $id)->first();
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
            return response()->json(['result' => 'success']);
        }
    }

    // public function uploadImage(Request $request) {

    //     if(isset($_POST["image"])){

    //         $id = $request->get('id');
    //         $driver =  SuperVisor::where('id', $id)->first();

    //         $base64_string = $_POST["image"];

    //         mt_srand(time());
    //         $imgName = mt_rand();  
    //         $imgName = $imgName.".jpg";      
    //         $outputfile = "".$imgName;

    //         //save as image.jpg in uploads/ folder
    //         $file_write = public_path('/')."/images/".$outputfile;

    //         file_put_contents($file_write, base64_decode($base64_string));
    //         return response()->json(['result' => "ddfsa"]);

        
    //         // $filehandler = fopen($outputfile, 'wb' ); 
            
    //         // fwrite($filehandler, base64_decode($base64_string));
            
    //         //file open with "w" mode treat as text file
    //         //file open with "wb" mode treat as binary file
            
    //         // we could add validation here with ensuring count($data)>1
        
    //         // clean up the file resource

    //         // fclose($filehandler);



    //         $driver->profile_image = url('/')."/images/".$outputfile;
    //         $driver->save();
    //         return response()->json(['result' => 'success']);
    //     }else{
    //         return response()->json(['result' => 'No image is submited.']);
    //     }
    // }

    public function uploadImage(Request $request) {

        if(isset($_POST["image"])){

            $id = $request->get('id');

            $base64_string = $_POST["image"];

            mt_srand(time());
            $imgName = mt_rand();  
            $imgName = $imgName.".jpg";      
            $outputfile = "".$imgName;

            $decoded_image = base64_decode($base64_string); // decode the file

            $f = finfo_open();
            $mime_type = finfo_buffer($f, $decoded_image, FILEINFO_MIME_TYPE);
            $ext = explode('/', $mime_type)[1];
            $ext = ".".$ext;
            $this->image_name .= $ext;

            $this->image_string = $base64_string;
            return $this->save($id);
        }else{
            return response()->json(['result' => 'No image is submited.']);
        }
    }

    

    public function save($id){
        if(!empty($this->image_name) && !empty($this->image_string)){
            return $this->progress($id);
        }
        else{
            return response()->json("Failed Upload.");
        }
    }

    private function progress($id){
        $imgarr = explode(',', $this->image_string);
        if(!isset($imgarr[0])){
            return response()->json("Error on post data image. String is not the expected string.");
        }
        $this->image = base64_decode($imgarr[0]);
        if(!is_null($this->image)){
            $file = $this->save_path . $this->image_name;
            if(file_exists($file)){
                return response()->json(['result' => 'Image already exists on server.']);
            }
            if(file_put_contents($file, $this->image) !== false){
                $user = SuperVisor::findOrFail($id);
                Storage::delete($user->profile_image);
                $user['picture'] = url('/').'/uploads/'.$this->image_name;
                $user->save();
                return response()->json("Image Saved to Server.");
            }
            else{
                return response()->json("Error writing to disk.");
            }
        }
        else{
            return response()->json("Error decoding base64 String.");
        }
    }

    public function saveFCMToken(Request $request) {
        $driver = SuperVisor::findOrFail($request->id);
        $driver->fcm_token = $request->fcm_token;
        $driver->save();
        return response()->json(['result' => 'success']);
    }

    public function sendNotificationToSupervisor($id, $messageBody)
    {
        if($id == "" || $id == null) return "null";
       // get a user to get the fcm_token that already sent.               from mobile apps 
       $supervisor = SuperVisor::findOrFail($id);
       $serverkey = env('FCM_SERVER_KEY');

       $return = FCMService::send(
          $supervisor->fcm_token,
          [
              'title' => 'Alnabali Supervisor',
              'body' => $messageBody,
              'android_channel_id' => 'channelId'
          ]
       );
       return response()->json(['result' => $supervisor->fcm_token, 'ddd' => $id, 'sss' => $return, 'ggg' => $serverkey]);
    }
}
