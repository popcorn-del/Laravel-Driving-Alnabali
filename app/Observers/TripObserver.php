<?php

namespace App\Observers;

use App\Models\DailyTripDetail;
use App\Models\Transaction;
use App\Models\Notification;
use App\Models\TripBus;

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
        $notification->message = 'Status of trip "' . $dailyTripDetail->trip_name . '" is changed to ' . $status . " from " . $oldStatus . ".";
        $notification->status = $dailyTripDetail->status;
        $notification->trip_id = $dailyTripDetail->id;
        $notification->trip_name = $dailyTripDetail->trip_name;
        $notification->disp_trip_id = $dailyTripDetail->trip_id;
        // $notification->save();

        $supervisor = json_decode($dailyTripDetail->supervisor);
        for ($i = 0; $i < count($supervisor); $i++) {
            $message_s = "New pending trip " . $dailyTripDetail->trip_id . " was assigned to " . $dailyTripDetail->dirver_name . ".";
            app('App\Http\Controllers\Admin\NotificationController')->saveSupervisorNotification($dailyTripDetail, $supervisor[$i], $message_s);
        }
        $message_d = "You have new pending trip " . $dailyTripDetail->trip_id . ".";
        app('App\Http\Controllers\Admin\NotificationController')->saveDriverNotification($dailyTripDetail, $dailyTripDetail->driver_id, $message_d);
    }

    /**
     * Handle the DailyTripDetail "updated" event.
     *
     * @param  \App\Models\DailyTripDetail  $dailyTripDetail
     * @return void
     */
    public function updated(DailyTripDetail $dailyTripDetail)
    {
        if ($dailyTripDetail->isDirty('status')) {
            $message_d = "";
            $message_s = "";
            $notification = new Notification;
            $notification->client_name = $dailyTripDetail->client_name;
            $notification->destination_name = $dailyTripDetail->destination_city;
            $notification->origin_name = $dailyTripDetail->origin_city;
            $notification->driver_name = $dailyTripDetail->dirver_name;
            $status = "Pending";
            $oldStatus = "Created";

            $dailyOldStatus = $dailyTripDetail->status;
            if ($dailyTripDetail->isDirty('status')) {
                $transaction = new Transaction;
                $tripbus = TripBus::where('trip_name', $dailyTripDetail->f_trip_id)->get();
                $transaction->old_status = $dailyTripDetail->getRawOriginal('status');
                $dailyOldStatus = $transaction->old_status;
            }

            if ($dailyTripDetail->status == 2) {
                $status = "Accepted";
                $message_d = $message_d . $status . " trip " . $dailyTripDetail->trip_id . ".";
                $message_s = $message_s . $status . " trip " . $dailyTripDetail->trip_id . ".";
            } else if ($dailyTripDetail->status == 3) {
                $status = "Rejected";
                $message_d = $message_d . $status . " trip " . $dailyTripDetail->trip_id . ".";
                $message_s = $message_s . $status . " trip " . $dailyTripDetail->trip_id . ".";
            } else if ($dailyTripDetail->status == 4) {
                $status = "Started";
                $message_d = $message_d . $status . " trip " . $dailyTripDetail->trip_id . ".";
                $message_s = $message_s . $status . " trip " . $dailyTripDetail->trip_id . ".";
            } else if ($dailyTripDetail->status == 5) {
                $status = "Canceled";
                $message_d = $message_d . $status . " trip " . $dailyTripDetail->trip_id . ".";
                $message_s = $message_s . $status . " trip " . $dailyTripDetail->trip_id . ".";
            } else if ($dailyTripDetail->status == 6) {
                $status = "Finished";
                $message_d = $message_d . $status . " trip " . $dailyTripDetail->trip_id . ".";
                $message_s = $message_s . $status . " trip " . $dailyTripDetail->trip_id . ".";
            } else if ($dailyTripDetail->status == 7) {
                $status = "Fake";
                $message_d = $message_d . $status . " trip " . $dailyTripDetail->trip_id . ".";
                $message_s = $message_s . $status . " trip " . $dailyTripDetail->trip_id . ".";
            } else if ($dailyTripDetail->status == 1) {
                $status = "Pending";
                $message_d = $message_d . $status . " trip " . $dailyTripDetail->trip_id . ".";
                $message_s = $message_s . $status . " trip " . $dailyTripDetail->trip_id . ".";
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
            $notification->message = 'Status of trip "' . $dailyTripDetail->trip_name . '" was changed to ' . $status . " from " . $oldStatus . ".";
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
            for ($i = 0; $i < count($supervisor); $i++) {
                $message_s = $dailyTripDetail->dirver_name . " has " . $message_s;
                app('App\Http\Controllers\Admin\NotificationController')->saveSupervisorNotification($dailyTripDetail, $supervisor[$i], $message_s);
            }
            $message_d = "You have been " . $message_d;
            app('App\Http\Controllers\Admin\NotificationController')->saveDriverNotification($dailyTripDetail, $dailyTripDetail->driver_id, $message_d);
        }
        //
        if ($dailyTripDetail->isDirty('status')) {
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
            $messageBody = 'Driver of trip "' . $dailyTripDetail->trip_name . '" was changed to ' . $newDriverName . " from " . $originDriverName;

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
                $message_s = "The trip " . $dailyTripDetail->trip_id . " was assigned to " . $newDriverName . " from " . $originDriverName . ".";
                app('App\Http\Controllers\Admin\NotificationController')->saveSupervisorNotification($dailyTripDetail, $supervisor[$i], $message_s);
            }
            $message_d_new = "You have new assigned trip " . $dailyTripDetail->trip_id . ".";
            $message_d_ori = "The trip has been Canceled.";
            app('App\Http\Controllers\Admin\NotificationController')->saveDriverNotification($dailyTripDetail, $newDriver, $message_d_new);
            app('App\Http\Controllers\Admin\NotificationController')->saveDriverNotification($dailyTripDetail, $originDriver, $message_d_ori);
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
}
