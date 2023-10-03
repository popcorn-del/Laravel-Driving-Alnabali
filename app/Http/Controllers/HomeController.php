<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

use App\Models\Client;
use App\Models\Driver;
use App\Models\Bus;
use App\Models\Trip;
use App\Models\DailyTripDetail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // if (view()->exists($request->path())) {
        //     return view($request->path());
        // }
        // return abort(404);
    }
    public function root()
    {
        // return view('index');
        $client = Client::select("*")
                        ->count();
        $driver = Driver::select("*")
                        ->count();
        $bus = Bus::select("*")
                  ->count();
        $trip = Trip::select("*")
                    ->count();
        $dailytrip = DailyTripDetail::select("*")
                                    ->count();
        return view('admin.pages.dashboard.index', [
            'client' => $client,
            'driver' => $driver,
            'bus' => $bus,
            'trip' => $trip,
            'dailytrip' => $dailytrip,
        ]);
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request, $id)
    {
        // return $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            // 'dob' => ['required', 'date', 'before:today'],
            // 'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');

        // if ($request->file('avatar')) {
        //     $avatar = $request->file('avatar');
        //     $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
        //     $avatarPath = public_path('/images/');
        //     $avatar->move($avatarPath, $avatarName);
        //     if (file_exists(public_path($user->avatar))) {
        //         unlink(public_path($user->avatar));
        //     }
        //     $user->avatar = '/images/' . $avatarName;
        // }
        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            return response()->json([
                'isSuccess' => true,
                'Message' => "User Details Updated successfully!"
            ], 200); // Status code here
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message' => "Something went wrong!"
            ], 200); // Status code here
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Your Current password does not matches with the password you provided. Please try again."
            ], 200); // Status code
        } else {
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Password updated successfully!"
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Something went wrong!"
                ], 200); // Status code here
            }
        }
    }

    public function change_password()
    {
        return view('admin.pages.profile.change_password');
    }

    public function changeProfile()
    {
        return view('admin.pages.profile.my_profile');
    }
}
