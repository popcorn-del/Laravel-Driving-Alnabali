<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DateTime extends Model
{
    use HasFactory;

    public static function changeDateTime($date, $time)
    {
        $data = DateTime::first();
        $data->date_format = $date;
        $data->time_format = $time;
        $data->save();

        if ($time == 1) {
            $timezone = 'Etc/GMT+3';
            $timezone1 = '+3:00';
        } else {
            $timezone = 'Etc/GMT+2';
            $timezone1 = '+2:00';
        }
        
        // Set the time zone for the current request only
        date_default_timezone_set($timezone);
        
        // Run the SQL query to update the session time zone
        $query = "SET time_zone = ?";
        DB::statement($query, [$timezone1]);
        Session::put('date', $data->date_format);
        return true;
    }

    public static function getDateTime()
    {
        $data = DateTime::first();
        return [
            'date' => $data->date_format,
            'time' => $data->time_format
        ];
    }
}
