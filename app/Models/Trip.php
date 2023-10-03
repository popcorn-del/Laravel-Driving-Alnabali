<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    static public function setInactive($f_value)
    {
        $models = Trip::where('client_id', $f_value)->get();
        foreach ($models as $key => $value) {
            $value->status = 0;
            $value->save();
        }
    }
}
