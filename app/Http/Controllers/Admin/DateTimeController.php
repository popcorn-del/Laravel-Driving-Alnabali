<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

use App\Models\DateTime;

class DateTimeController extends Controller
{
    public function index(){
        $data = DateTime::first();
        $lang=app()->getLocale();
        return view('admin.pages.datetime.index', [
            "data" => $data,
            "lang" => $lang
        ]);
        return view('admin.pages.datetime.index');
    }

    public function store(Request $request)
    {
        $data = DateTime::changeDateTime($request->date_format,$request->time_format);
        return redirect()->back()->with('success','Date & Time Setting run successfully');
    }
}
