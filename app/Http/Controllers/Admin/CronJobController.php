<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Carbon;

class CronJobController extends Controller
{
    public function index(){
        return view('admin.pages.cronjob.index');
    }
    public function start(){
        \Artisan::call('demo:cron');
        \Artisan::call('five:update');
        return redirect()->back()->with('success','CronJob run successfully');
    }
}
