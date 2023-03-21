<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FCMService
{ 
    public static function send($token, $notification)
    {
        $return = Http::acceptJson()->withToken(env('FCM_SERVER_KEY'))->post(
            'https://fcm.googleapis.com/fcm/send',
            [
                'to' => $token,
                'notification' => $notification,
                'priority' => 'high',
            ]
        );
        return $return;
    }
}
