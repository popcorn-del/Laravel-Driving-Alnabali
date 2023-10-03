<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripBus extends Model
{
    use HasFactory;

    static public function setInactive($field,$f_value)
    {
        $models = TripBus::where($field, $f_value)->get();
        foreach ($models as $key => $value) {
            $value->status = 0;
            $value->save();
        }
    }
}
