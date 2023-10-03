<?php

namespace App\Observers;

use App\Models\DailyTripDetail;
use App\Models\Transaction;
use App\Models\Notification;
use App\Models\TripBus;
use App\Models\Driver;
use App\Models\Trip;

class TripObserver
{
    /**
     * Handle the DailyTripDetail "created" event.
     *
     * @param  \App\Models\DailyTripDetail  $dailyTripDetail
     * @return void
     */
    public function created(DailyTripDetail $dailyTripDetail)
    {
        //
        $transaction = new Transaction;
        $notification = new Notification;
        $tripbus = TripBus::where('trip_name', $dailyTripDetail->f_trip_id)->get();
        \Log::info("*****======-----TripObserver::create DailyTripDetail create Notifacation-----======*****");
            
        $transaction->client_name = $dailyTripDetail->client_name;
        $transaction->destination_name = $dailyTripDetail->destination_city;
        $transaction->origin_name = $dailyTripDetail->origin_city;
        $transaction->driver_name = $dailyTripDetail->dirver_name;
        $transaction->new_status = $dailyTripDetail->status;
        $transaction->old_status = 100;
        $transaction->trip_id = $dailyTripDetail->f_trip_id;
        $transaction->disp_trip_id = $dailyTripDetail->trip_id;
        $transaction->daily_trip_id = $dailyTripDetail->id;
        $transaction->trip_name = $dailyTripDetail->trip_name;
        $transaction->bus_id = $tripbus[0]->bus_no;
        $transaction->save();
        $notification->client_name = $dailyTripDetail->client_name;
        $notification->destination_name = $dailyTripDetail->destination_city;
        $notification->origin_name = $dailyTripDetail->origin_city;
        $notification->driver_name = $dailyTripDetail->dirver_name;
        // $notification->notification_date
        $status = "Pending";
        $oldStatus = "Created";
        if ($dailyTripDetail->status == 2) {
            $status = "Accepted";
        } else if ($dailyTripDetail->status == 3) {
            $status = "Rejected";
        } else if ($dailyTripDetail->status == 4) {
            $status = "Started";
        } else if ($dailyTripDetail->status == 5) {
            $status = "Canceled";
        } else if ($dailyTripDetail->status == 6) {
            $status = "Finished";
        } else if ($dailyTripDetail->status == 7) {
            $status = "Fake";
        }

        if ($transaction->old_status == 2) {
            $oldStatus = "Accepted";
        } else if ($transaction->old_status == 3) {
            $oldStatus = "Rejected";
        } else if ($transaction->old_status == 4) {
            $oldStatus = "Started";
        } else if ($transaction->old_status == 5) {
            $oldStatus = "Canceled";
        } else if ($transaction->old_status == 6) {
            $oldStatus = "Finished";
        } else if ($transaction->old_status == 7) {
            $oldStatus = "Fake";
        } else if ($transaction->old_status == 1) {
            $oldStatus = "Pending";
        }
        $notification->message = 'Status of trip (' . $dailyTripDetail->trip_name . ') is changed to ' . $status . " from " . $oldStatus . ".";
        $notification->status = $dailyTripDetail->status;
        $notification->trip_id = $dailyTripDetail->id;
        $notification->trip_name = $dailyTripDetail->trip_name;
        $notification->disp_trip_id = $dailyTripDetail->trip_id;
        // $notification->save();

        $supervisor = json_decode($dailyTripDetail->supervisor);
        if(is_object($supervisor)){
            for ($i = 0; $i < count($supervisor); $i++) {
                $message_s = "New trip was assigned to:\n". $dailyTripDetail->dirver_name;
                $driver = Driver::where('name_en', $dailyTripDetail->dirver_name)->first();
                if($driver){
                    $dirver_name_ar = $driver->name_ar;
                } else{
                    $dirver_name_ar = $dailyTripDetail->dirver_name;
                }
                $msg = "New trip was assigned to:\n". $dailyTripDetail->dirver_name."::::تم تخصيص رحلة جديدة إلى:\n". $dirver_name_ar;
                app('App\Http\Controllers\Admin\NotificationController')->saveSupervisorNotification($dailyTripDetail, $supervisor[$i], $message_s, $msg);
            }
        }
        
        $message_d = "You have new pending trip (" . $dailyTripDetail->trip_name . ").";
        $trip = Trip::where('id', $dailyTripDetail->id)->first();
        if($trip){
            $trip_name_ar = $trip->trip_name_ar;
        } else{
            $trip_name_ar = $dailyTripDetail->trip_name;
        }
        $msg = "You have new pending trip (" . $dailyTripDetail->trip_name . ").::::لديك رحلة جديدة معلقة (" . $trip_name_ar . ").";
        app('App\Http\Controllers\Admin\NotificationController')->saveDriverNotification($dailyTripDetail, $dailyTripDetail->driver_id, $message_d, $msg);
    }

    /**
     * Handle the DailyTripDetail "updated" event.
     *
     * @param  \App\Models\DailyTripDetail  $dailyTripDetail
     * @return void
     */
    public function updated(DailyTripDetail $dailyTripDetail)
    {
        \Log::info("*****======-----DailyTripDetail Obsever-----======*****");
        if ($dailyTripDetail->isDirty('status')) {
            $message_d = "";
            $message_s = "";
            \Log::info("*****======-----TripObserver:DailyTripDetail create Notifacation-----======*****");
            $notification = new Notification;
            $notification->client_name = $dailyTripDetail->client_name;
            $notification->destination_name = $dailyTripDetail->destination_city;
            $notification->origin_name = $dailyTripDetail->origin_city;
            $notification->driver_name = $dailyTripDetail->dirver_name;
            $status = "Pending";
            $oldStatus = "Created";

            $dailyOldStatus = $dailyTripDetail->status;
            if ($dailyTripDetail->isDirty('status')) {
                \Log::info("*****======-----TripObserver:DailyTripDetail create Notifacation => create Transaction -----======*****");
                $transaction = new Transaction;
                $tripbus = TripBus::where('trip_name', $dailyTripDetail->f_trip_id)->get();
                $transaction->old_status = $dailyTripDetail->getRawOriginal('status');
                $dailyOldStatus = $transaction->old_status;
            }

            if ($dailyTripDetail->status == 2) {
                $status = "Accepted";
                $message_d = "You have been ".$status. " trip";
                $message_s = "has accepted the trip.";
            } else if ($dailyTripDetail->status == 3) {
                $status = "Rejected";
                $message_d = "You have been ".$status. " trip";
                $message_s = "has rejected the trip.";
            } else if ($dailyTripDetail->status == 4) {
                $status = "Started";
                $message_d = "You have been ".$status. " trip";
                $message_s = "has started the trip.";
            } else if ($dailyTripDetail->status == 5) {
                $status = "Canceled";
                $message_d = "You have been ".$status. " trip";
                $message_s = "has canceled the trip.";
            } else if ($dailyTripDetail->status == 6) {
                $status = "Finished";
                $message_d = "You have been ".$status. " trip";
                $message_s = "has finished the trip.";
            } else if ($dailyTripDetail->status == 7) {
                $status = "Fake";
                $message_d = "You have been ".$status. " trip";
                $message_s = " fake the trip.";
            } else if ($dailyTripDetail->status == 1) {
                $status = "Pending";
                $message_d = "You have been ".$status. " trip";
                $message_s = "has pending the trip.";
            }

            if ($dailyOldStatus == 2) {
                $oldStatus = "Accepted";
            } else if ($dailyOldStatus == 3) {
                $oldStatus = "Rejected";
            } else if ($dailyOldStatus == 4) {
                $oldStatus = "Started";
            } else if ($dailyOldStatus == 5) {
                $oldStatus = "Canceled";
            } else if ($dailyOldStatus == 6) {
                $oldStatus = "Finished";
            } else if ($dailyOldStatus == 7) {
                $oldStatus = "Fake";
            } else if ($dailyOldStatus == 1) {
                $oldStatus = "Pending";
            }
            $notification->message = 'Status of trip ("' . $dailyTripDetail->trip_name . '") was changed to ' . $status . " from " . $oldStatus . ".";
            $notification->status = $dailyTripDetail->status;
            $notification->trip_id = $dailyTripDetail->id;
            $notification->trip_name = $dailyTripDetail->trip_name;
            $notification->disp_trip_id = $dailyTripDetail->trip_id;
            // $notification->save();
            // app('App\Http\Controllers\Admin\DriverController')->sendNotificationToDriver($dailyTripDetail->driver_id, $notification->message);
            // $supervisor_id = json_decode($dailyTripDetail->supervisor);
            // for ($i = 0; $i < count($supervisor_id); $i++) {
            //     app('App\Http\Controllers\Admin\SuperVisorController')->sendNotificationToSupervisor($supervisor_id[$i], $notification->message);
            // }

            $supervisor = json_decode($dailyTripDetail->supervisor);
            $temp = $message_s;
            for ($i = 0; $i < count($supervisor); $i++) {
                $message_s = "(".$dailyTripDetail->dirver_name . ") " . $temp;
                $driver = Driver::where('name_en', $dailyTripDetail->dirver_name)->first();
                if($driver){
                    $dirver_name_ar = $driver->name_ar;
                } else{
                    $dirver_name_ar = $dailyTripDetail->dirver_name;
                }
                $msg = "(".$dailyTripDetail->dirver_name . ") " . $temp."::::(".$dirver_name_ar . ") ".$this->makeMessage($temp);
                \Log::info("*****======-----TripObserver:DailyTripDetail create Notifacation => supervisor :".$message_s."-----======*****");
                app('App\Http\Controllers\Admin\NotificationController')->saveSupervisorNotification($dailyTripDetail, $supervisor[$i], $message_s, $msg);
            }
            $message_ds = $message_d. " (" . $dailyTripDetail->trip_name . ").";
            $trip = Trip::where('id', $dailyTripDetail->id)->first();
            if($trip){
                $trip_name_ar = $trip->trip_name_ar;
            } else{
                $trip_name_ar = $dailyTripDetail->trip_name;
            }
            $msg = $message_d. " (" . $dailyTripDetail->trip_name . ").::::".$this->makeMessage($message_d). " (" . $trip_name_ar . ").";
            \Log::info("*****======-----TripObserver:DailyTripDetail create Notifacation => driver :".$message_d."-----======*****");
            app('App\Http\Controllers\Admin\NotificationController')->saveDriverNotification($dailyTripDetail, $dailyTripDetail->driver_id, $message_ds, $msg);
        }
        //
        if ($dailyTripDetail->isDirty('status')) {
            \Log::info("*****======-----TripObserver:DailyTripDetail create Notifacation => new Transaction -----======*****");
            $transaction = new Transaction;
            $tripbus = TripBus::where('trip_name', $dailyTripDetail->f_trip_id)->get();

            $transaction->client_name = $dailyTripDetail->client_name;
            $transaction->destination_name = $dailyTripDetail->destination_city;
            $transaction->origin_name = $dailyTripDetail->origin_city;
            $transaction->driver_name = $dailyTripDetail->dirver_name;
            $transaction->new_status = $dailyTripDetail->status;
            $transaction->old_status = $dailyTripDetail->getRawOriginal('status');
            $transaction->trip_id = $dailyTripDetail->f_trip_id;
            $transaction->disp_trip_id = $dailyTripDetail->trip_id;
            $transaction->daily_trip_id = $dailyTripDetail->id;
            $transaction->trip_name = $dailyTripDetail->trip_name;
            $transaction->bus_id = $tripbus[0]->bus_no;
            $transaction->save();
        }

        if ($dailyTripDetail->isDirty('driver_id') || $dailyTripDetail->isDirty('dirver_name')) {
            $originDriver = $dailyTripDetail->getRawOriginal('driver_id');
            $originDriverName = $dailyTripDetail->getRawOriginal('dirver_name');
            $newDriver = $dailyTripDetail->driver_id;
            $newDriverName = $dailyTripDetail->dirver_name;
            $messageBody = 'Driver of trip (' . $dailyTripDetail->trip_name . ') was changed to (' . $newDriverName . ") from (" . $originDriverName.")";
            \Log::info("*****======-----TripObserver:DailyTripDetail create Notifacation => new Transaction ".$messageBody."-----======*****");
            
            $notification = new Notification;
            $notification->client_name = $dailyTripDetail->client_name;
            $notification->destination_name = $dailyTripDetail->destination_city;
            $notification->origin_name = $dailyTripDetail->origin_city;
            $notification->driver_name = $newDriverName;

            $notification->message = $messageBody;
            $notification->status = $dailyTripDetail->status;
            $notification->trip_id = $dailyTripDetail->id;
            $notification->trip_name = $dailyTripDetail->trip_name;
            $notification->disp_trip_id = $dailyTripDetail->trip_id;
            // $notification->save();

            // app('App\Http\Controllers\Admin\DriverController')->sendNotificationToDriver($originDriver, $messageBody);
            // app('App\Http\Controllers\Admin\DriverController')->sendNotificationToDriver($newDriver, $messageBody);

            // $supervisor_id = json_decode($dailyTripDetail->supervisor);
            // for ($i = 0; $i < count($supervisor_id); $i++) {
            //     app('App\Http\Controllers\Admin\SuperVisorController')->sendNotificationToSupervisor($supervisor_id[$i], $messageBody);
            // }

            $supervisor = json_decode($dailyTripDetail->supervisor);
            for ($i = 0; $i < count($supervisor); $i++) {
                $message_s = "The trip was assigned to:\n". $dailyTripDetail->dirver_name;
                $driver = Driver::where('name_en', $dailyTripDetail->dirver_name)->first();
                if($driver){
                    $dirver_name_ar = $driver->name_ar;
                } else{
                    $dirver_name_ar = $dailyTripDetail->dirver_name;
                }
                $msg = "The trip was assigned to:\n". $dailyTripDetail->dirver_name."::::تم تخصيص الرحلة ل:\n". $dirver_name_ar;
                app('App\Http\Controllers\Admin\NotificationController')->saveSupervisorNotification($dailyTripDetail, $supervisor[$i], $message_s, $msg);
            }
            $message_d_new = "You have new assigned trip (" . $dailyTripDetail->trip_name . ").";
            $trip = Trip::where('id', $dailyTripDetail->id)->first();
            if($trip){
                $trip_name_ar = $trip->trip_name_ar;
            } else{
                $trip_name_ar = $dailyTripDetail->trip_name;
            }
            $msg = "You have new assigned trip (" . $dailyTripDetail->trip_name . ").::::لديك رحلة جديدة مخصصة (". $trip_name_ar . ").";
            $message_d_ori = "The trip has been Canceled.";
            app('App\Http\Controllers\Admin\NotificationController')->saveDriverNotification($dailyTripDetail, $newDriver, $message_d_new, $msg);
            $msg = "The trip has been Canceled.::::تم إلغاء الرحلة.";
            app('App\Http\Controllers\Admin\NotificationController')->saveDriverNotification($dailyTripDetail, $originDriver, $message_d_ori, $msg);
        }
    }

    /**
     * Handle the DailyTripDetail "deleted" event.
     *
     * @param  \App\Models\DailyTripDetail  $dailyTripDetail
     * @return void
     */
    public function deleted(DailyTripDetail $dailyTripDetail)
    {
        //
    }

    /**
     * Handle the DailyTripDetail "restored" event.
     *
     * @param  \App\Models\DailyTripDetail  $dailyTripDetail
     * @return void
     */
    public function restored(DailyTripDetail $dailyTripDetail)
    {
        //
    }

    /**
     * Handle the DailyTripDetail "force deleted" event.
     *
     * @param  \App\Models\DailyTripDetail  $dailyTripDetail
     * @return void
     */
    public function forceDeleted(DailyTripDetail $dailyTripDetail)
    {
        //
    }
    
    private function makeMessage($message)
    {
        $message = str_replace("You have new pending trip", "لديك رحلة جديدة معلقة", $message);
        $message = str_replace("You have been Pending trip", "لقد كنت في انتظار الرحلة", $message);
        $message = str_replace("You have been Accepted trip", "لقد تم قبولك الرحلة", $message);
        $message = str_replace("You have been Rejected trip", "تم رفض رحلتك ", $message);
        $message = str_replace("You have been Started trip", "لقد بدأت رحلتك", $message);
        $message = str_replace("You have been Canceled trip", "لقد تم إلغاء رحلتك", $message);
        $message = str_replace("You have been Finished trip", "لقد أنهيت رحلتك ", $message);
        $message = str_replace("You have been Fake trip", "لقد قمت برحلة وهمية ", $message);

        $message = str_replace("has accepted the trip", "قبل الرحلة.", $message);
        $message = str_replace("has rejected the trip", "رفض الرحلة", $message);
        $message = str_replace("has started the trip", "بدأ الرحلة", $message);
        $message = str_replace("has canceled the trip", " ألغى الرحلة", $message);
        $message = str_replace("has finished the trip", " أنهى الرحلة", $message);
        $message = str_replace("has pending the trip", "لديه رحلة انتظار", $message);

        $message = str_replace("has accepted the", "قبل الرحلة.", $message);
        $message = str_replace("has rejected the", "رفض الرحلة", $message);
        $message = str_replace("has started the", "بدأ الرحلة", $message);
        $message = str_replace("has canceled the", " ألغى الرحلة", $message);
        $message = str_replace("has finished the", " أنهى الرحلة", $message);
        $message = str_replace("has pending the", "لديه رحلة انتظار", $message);

        return $message;
    }
}
