<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DailyTripController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//frontend
Route::get('/', [App\Http\Controllers\FrontController::class, 'index'])->name('front.home');

//Update User Details
Route::get('/update-password/', [App\Http\Controllers\HomeController::class, 'change_password'])->name('change_password');
Route::get('/update-profile/', [App\Http\Controllers\HomeController::class, 'changeProfile'])->name('changeProfile');
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

// admin dashboard
Route::prefix('/admin')->middleware(['auth:web', 'Admin'])->group(function () {
    Route::get('daily/table', [App\Http\Controllers\Admin\CommonController::class, 'setTableData'])->name('admin.daily.table');

    Route::middleware('role_admin:0')->group(function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');
    });

    //client
    Route::middleware('role_admin:1')->group(function () {
        Route::resource('client', App\Http\Controllers\Admin\ClientController::class, ['as' => 'admin']);
    });
    //driver
    Route::middleware('role_admin:2')->group(function () {
        Route::resource('driver', App\Http\Controllers\Admin\DriverController::class, ['as' => 'admin']);
        Route::post('driver/status', [App\Http\Controllers\Admin\DriverController::class, 'status'])->name('admin.driver.status');
    });
    //bus
    Route::middleware('role_admin:3')->group(function () {
        Route::resource('bus', App\Http\Controllers\Admin\BusController::class, ['as' => 'admin']);
        Route::get('/admin/bus/model/{id}', [App\Http\Controllers\Admin\BusController::class, 'getModel'])->name('admin.bus.model');
        Route::get('/admin/bus/modelAll', [App\Http\Controllers\Admin\BusController::class, 'getModelAll'])->name('admin.bus.modelAll');
        Route::post('bus/status', [App\Http\Controllers\Admin\BusController::class, 'status'])->name('admin.bus.status');
    });

    //trips
    Route::middleware('role_admin:4')->group(function () {
        Route::resource('trip', App\Http\Controllers\Admin\TripController::class, ['as' => 'admin']);
        Route::post('trip/status', [App\Http\Controllers\Admin\TripController::class, 'status'])->name('admin.trip.status');
    });

    //trip buses
    Route::middleware('role_admin:5')->group(function () {
        Route::resource('trip_bus', App\Http\Controllers\Admin\TripsBusController::class, ['as' => 'admin']);
        Route::post('trip_bus/status', [App\Http\Controllers\Admin\TripsBusController::class, 'status'])->name('admin.trip_bus.status');
        Route::post('trip_bus/tripname', [App\Http\Controllers\Admin\TripsBusController::class, 'tripname'])->name('admin.trip_bus.tripname');
    });

    //daily trips
    Route::middleware('role_admin:6')->group(function () {
        Route::resource('daily_trip', App\Http\Controllers\Admin\DailyTripController::class, ['as' => 'admin']);
    });    

    //notifications
    Route::middleware('role_admin:7')->group(function () {
        Route::resource('notification', App\Http\Controllers\Admin\NotificationController::class, ['as' => 'admin']);
    });    

    //transactions
    Route::middleware('role_admin:8')->group(function () {
        Route::resource('transaction', App\Http\Controllers\Admin\TransactionController::class, ['as' => 'admin']);
    });    

    //maintainence records
    Route::middleware('role_admin:9')->group(function () {
        Route::resource('maintenance', App\Http\Controllers\Admin\MaintenanceController::class, ['as' => 'admin']);
    });  

    //michallenous
    Route::middleware('role_admin:10')->group(function () {
        Route::prefix('/miscellaneous')->group(function () {
            Route::resource('city', App\Http\Controllers\Admin\Miscellaneous\CityController::class, ['as' => 'admin.miscellaneous']);
            Route::post('city/status', [App\Http\Controllers\Admin\Miscellaneous\CityController::class, 'status'])->name('admin.miscellaneous.city.status');
            Route::resource('client_type', App\Http\Controllers\Admin\Miscellaneous\ClientTypeController::class, ['as' => 'admin.miscellaneous']);
            Route::post('client_type/status', [App\Http\Controllers\Admin\Miscellaneous\ClientTypeController::class, 'status'])->name('admin.miscellaneous.client_type.status');
            Route::resource('contract_type', App\Http\Controllers\Admin\Miscellaneous\ContractTypeController::class, ['as' => 'admin.miscellaneous']);
            Route::post('contract_type/status', [App\Http\Controllers\Admin\Miscellaneous\ContractTypeController::class, 'status'])->name('admin.miscellaneous.contract_type.status');
            Route::resource('bus_type', App\Http\Controllers\Admin\Miscellaneous\BusTypeController::class, ['as' => 'admin.miscellaneous']);
            Route::post('bus_type/status', [App\Http\Controllers\Admin\Miscellaneous\BusTypeController::class, 'status'])->name('admin.miscellaneous.bus_type.status');
            Route::resource('bus_model', App\Http\Controllers\Admin\Miscellaneous\BusModelController::class, ['as' => 'admin.miscellaneous']);
            Route::post('bus_model/status', [App\Http\Controllers\Admin\Miscellaneous\BusModelController::class, 'status'])->name('admin.miscellaneous.bus_model.status');
            Route::resource('bus_size', App\Http\Controllers\Admin\Miscellaneous\BusSizeController::class, ['as' => 'admin.miscellaneous']);
            Route::post('bus_size/status', [App\Http\Controllers\Admin\Miscellaneous\BusSizeController::class, 'status'])->name('admin.miscellaneous.bus_size.status');
            Route::resource('bus_maintenance', App\Http\Controllers\Admin\Miscellaneous\MaintenanceController::class, ['as' => 'admin.miscellaneous']);
            Route::post('bus_maintenance/status', [App\Http\Controllers\Admin\Miscellaneous\MaintenanceController::class, 'status'])->name('admin.miscellaneous.bus_maintenance.status');
            Route::resource('area', App\Http\Controllers\Admin\Miscellaneous\AreaController::class, ['as' => 'admin.miscellaneous']);
            Route::post('area/status', [App\Http\Controllers\Admin\Miscellaneous\AreaController::class, 'status'])->name('admin.miscellaneous.area.status');
        });
    });  

    //  app supervisor
    Route::middleware('role_admin:11')->group(function () {
        Route::resource('super_visor', App\Http\Controllers\Admin\SuperVisorController::class, ['as' => 'admin']);
        Route::post('super_visor/status', [App\Http\Controllers\Admin\SuperVisorController::class, 'status'])->name('admin.super_visor.status');
    });  



    //user_role
    Route::middleware('role_admin:12')->group(function () {
        Route::resource('user_role', App\Http\Controllers\Admin\UserRoleController::class, ['as' => 'admin']);
    }); 

    // users
    Route::middleware('role_admin:13')->group(function () {
        Route::resource('user', App\Http\Controllers\Admin\UserController::class, ['as' => 'admin']);
        Route::post('user/status', [App\Http\Controllers\Admin\UserController::class, 'status'])->name('admin.user.status');
    });  

    //reports
    Route::middleware('role_admin:14')->group(function () {

        Route::prefix('/reports')->group(function () {
            Route::resource('trips_client', App\Http\Controllers\Admin\Reports\TripsClientController::class, ['as' => 'admin.reports']);
            Route::resource('trips_bus', App\Http\Controllers\Admin\Reports\TripsBusController::class, ['as' => 'admin.reports']);
            Route::resource('trips_type', App\Http\Controllers\Admin\Reports\TripsTypeController::class, ['as' => 'admin.reports']);
            Route::resource('trips_driver', App\Http\Controllers\Admin\Reports\TripsDriverController::class, ['as' => 'admin.reports']);
            Route::resource('trips_bus_size', App\Http\Controllers\Admin\Reports\TripsBusSizeController::class, ['as' => 'admin.reports']);
            Route::resource('trips_client_type', App\Http\Controllers\Admin\Reports\TripsClientTypeController::class, ['as' => 'admin.reports']);
            Route::resource('trips_contract_type', App\Http\Controllers\Admin\Reports\TripsContractTypeController::class, ['as' => 'admin.reports']);
            Route::resource('trips_owership', App\Http\Controllers\Admin\Reports\TripsOwnerShipController::class, ['as' => 'admin.reports']);
        });
    });
    
    //cronjob
    Route::middleware('role_admin:15')->group(function () {
        Route::get('/cronjob', [App\Http\Controllers\Admin\CronJobController::class, 'index'])->name('cronjob');
        Route::post('/cronjob/start', [App\Http\Controllers\Admin\CronJobController::class, 'start'])->name('cronjob.start');
    });  

    //settings
    Route::middleware('role_admin:16')->group(function () {
        Route::get('/datetime', [App\Http\Controllers\Admin\DateTimeController::class, 'index'])->name('datetime');
        Route::post('/datetime', [App\Http\Controllers\Admin\DateTimeController::class, 'store'])->name('datetime.save');
    }); 







});



// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode2 = Artisan::call('route:clear');
    // return what you want
});


Route::get('/admin/client/startdate/{id}', [App\Http\Controllers\Admin\ClientController::class, 'getStartDate'])->name('admin.client.startdate');
Route::get('/admin/trip/area/{id}', [App\Http\Controllers\Admin\TripController::class, 'getArea'])->name('admin.trip.area');
Route::get('/admin/trip/areaAll', [App\Http\Controllers\Admin\TripController::class, 'getAreaAll'])->name('admin.trip.areaAll');

Route::get('/admin/tripbus/busno/{id}', [App\Http\Controllers\Admin\TripsBusController::class, 'getbusno'])->name('admin.tripbus.busno');
Route::get('/admin/tripbus/tripnamebyid/{id}', [App\Http\Controllers\Admin\TripsBusController::class, 'getTripName'])->name('admin.tripbus.tripnamebyid');
Route::get('/admin/tripbus/tripnameAll', [App\Http\Controllers\Admin\TripsBusController::class, 'getTripNameAll'])->name('admin.tripbus.tripnameAll');


Route::get('/admin/daily/task', [App\Http\Controllers\Admin\DailyTripController::class, 'addDailyTrip'])->name('admin.daily.task');


////////////////////////////////////////////////////////////
/////////////////////* Client */////////////////////////////
////////////////////////////////////////////////////////////
Route::get('/android/client/avatar/{id}', [App\Http\Controllers\Admin\ClientController::class, 'getAvatar'])->name('android.client.avatar');

////////////////////////////////////////////////////////////
//////////////////////* Driver App *////////////////////////
////////////////////////////////////////////////////////////

Route::post('/android/driver/login', [App\Http\Controllers\Admin\DriverController::class, 'driverLogin'])->name('android.driver.login');
Route::post('/android/driver/pwd/change', [App\Http\Controllers\Admin\DriverController::class, 'changePassword'])->name('android.driver.password.change');
Route::get('/android/driver/profile/{id}', [App\Http\Controllers\Admin\DriverController::class, 'getProfile'])->name('android.driver.profile');
Route::post('/android/driver/profile_edit', [App\Http\Controllers\Admin\DriverController::class, 'editProfile'])->name('android.driver.profile_edit');
Route::get('/android/driver/token', [App\Http\Controllers\Admin\DriverController::class, 'getToken'])->name('android.driver.token');
Route::post('/android/driver/upload/image', [App\Http\Controllers\Admin\DriverController::class, 'uploadImage'])->name('android.supervisor.upload.image');
Route::post('/android/driver/remove_image', [App\Http\Controllers\Admin\DriverController::class, 'removeImage'])->name('android.supervisor.remove_image.image');

Route::post('/android/driver/save/fcm_token', [App\Http\Controllers\Admin\DriverController::class, 'saveFCMToken'])->name('android.driver.save.fcm_token');

////////////////////////////////////////////////////////////
//////////////////////* Supervisor App *////////////////////
////////////////////////////////////////////////////////////

Route::post('/android/supervisor/login', [App\Http\Controllers\Admin\SuperVisorController::class, 'driverLogin'])->name('android.supervisor.login');
Route::post('/android/supervisor/pwd/change', [App\Http\Controllers\Admin\SuperVisorController::class, 'changePassword'])->name('android.supervisor.password.change');
Route::get('/android/supervisor/profile/{id}', [App\Http\Controllers\Admin\SuperVisorController::class, 'getProfile'])->name('android.supervisor.profile');
Route::post('/android/supervisor/profile_edit', [App\Http\Controllers\Admin\SuperVisorController::class, 'editProfile'])->name('android.supervisor.profile_edit');
Route::post('/android/supervisor/upload/image', [App\Http\Controllers\Admin\SuperVisorController::class, 'uploadImage'])->name('android.supervisor.upload.image');
Route::post('/android/supervisor/upload_remove/image', [App\Http\Controllers\Admin\SuperVisorController::class, 'removeImage'])->name('android.supervisor.remove_image.image');
Route::get('/android/supervisor/token', [App\Http\Controllers\Admin\SuperVisorController::class, 'getToken'])->name('android.supervisor.token');
Route::get('/android/supervisor/all', [App\Http\Controllers\Admin\SuperVisorController::class, 'getAll'])->name('android.supervisor.all');

Route::post('/android/supervisor/save/fcm_token', [App\Http\Controllers\Admin\SuperVisorController::class, 'saveFCMToken'])->name('android.supervisor.save.fcm_token');
Route::get('/android/supervisor/send/notification/{id}', [App\Http\Controllers\Admin\SuperVisorController::class, 'sendNotificationToSupervisor'])->name('android.supervisor.send.notification');

////////////////////////////////////////////////////////////
//////////////////////* Daily Trip *////////////////////////
////////////////////////////////////////////////////////////

Route::post('/android/daily-trip/today', [App\Http\Controllers\Admin\DailyTripController::class, 'getTodayTrip'])->name('android.daily-trip.today');
Route::post('/android/daily-trip/last', [App\Http\Controllers\Admin\DailyTripController::class, 'getLastTrip'])->name('android.daily-trip.last');
Route::get('/android/area', [App\Http\Controllers\Admin\DailyTripController::class, 'getAllArea'])->name('android.area');
Route::get('/android/city', [App\Http\Controllers\Admin\DailyTripController::class, 'getAllCity'])->name('android.city');

Route::get('/android/daily-trip/{id}', [App\Http\Controllers\Admin\DailyTripController::class, 'getDailyTrip'])->name('android.daily-trip.driver');


Route::post('/android/daily-trip/command', [App\Http\Controllers\Admin\DailyTripController::class, 'setStatus'])->name('android.daily-trip.command');
Route::post('/android/daily-trip/edit', [App\Http\Controllers\Admin\DailyTripController::class, 'editDailyTrip'])->name('android.daily-trip.edit');

////////////////////////////////////////////////////////////
//////////////////////* Notification *//////////////////////
////////////////////////////////////////////////////////////
Route::get('/android/notification/today', [App\Http\Controllers\Admin\NotificationController::class, 'getTodayNotification'])->name('android.notification.today');
Route::get('/android/notification/all/{id}/{lang?}', [App\Http\Controllers\Admin\NotificationController::class, 'getAllNotification'])->name('android.notification.all');
Route::post('/android/notification/mark-read/{id}', [App\Http\Controllers\Admin\NotificationController::class, 'markAsRead'])->name('android.notification.all');

////////////////////////////////////////////////////////////
/////////////////////* DriverLocation */////////////////////
////////////////////////////////////////////////////////////
Route::post('/android/driver-location/update', [App\Http\Controllers\Admin\DriverLocationController::class, 'updateLocation'])->name('android.driver-location.update');
Route::post('/android/driver-status/disable', [App\Http\Controllers\Admin\DriverLocationController::class, 'disableStatus'])->name('android.driver-status.disable');
Route::post('/android/driver-location', [App\Http\Controllers\Admin\DriverLocationController::class, 'getDriver'])->name('android.driver-location');

////////////////////////////////////////////////////////////
/////////////////////* Transaction *////////////////////////
////////////////////////////////////////////////////////////
Route::get('/android/transaction/{id}', [App\Http\Controllers\Admin\TransactionController::class, 'getTransaction'])->name('android.transaction');


Route::get('/android/driver/all', [App\Http\Controllers\Admin\DriverController::class, 'getDrivers'])->name('android.driver.all');
Route::get('/android/bussize/all', [App\Http\Controllers\Admin\Miscellaneous\BusSizeController::class, 'getBusSizes'])->name('android.bussize.all');
Route::get('/android/bus/all', [App\Http\Controllers\Admin\BusController::class, 'getBuses'])->name('android.bus.all');


////////////////////////////////////////////////////////////
///////////////////////////* FCM *//////////////////////////
////////////////////////////////////////////////////////////
Route::post('sendNotification', [NotificationController::class, 'sendNotification'])->name('send.notification');
Route::get('push-notification/driver/{id}',function($id){
    app('App\Http\Controllers\Admin\DriverController')->sendNotificationToDriver($id, 'testing driver notification');
    return 'send successfully';
});

Route::get('push-notification/supervisor/{id}',function($id){
    app('App\Http\Controllers\Admin\SuperVisorController')->sendNotificationToSupervisor($id, 'testing supervisor notification');
    return 'send successfully';
});
