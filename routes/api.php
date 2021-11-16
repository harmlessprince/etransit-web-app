<?php

use App\Http\Controllers\Api\AuthUser;
use App\Http\Controllers\Api\Booking;
use App\Http\Controllers\Api\Partner;
use App\Http\Controllers\Api\PasswordReset;
use App\Http\Controllers\Api\Payment;
use App\Http\Controllers\Api\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1'], function() {

    Route::post('register', [AuthUser::class , 'register']);
    Route::post('login', [AuthUser::class , 'authenticate']);
    Route::post('/forgot-password', [PasswordReset::class, 'forgotPasswordNotification']);
    Route::post('/reset-password', [PasswordReset::class, 'resetPassword']);
    // The callback url after a payment
    Route::get('/rave/callback', [Payment::class, 'callback'])->name('callback');
    //store partners
    Route::post('/partners/create' , [Partner::class , 'store']);

    Route::group(['middleware' => 'jwt.verify'], function() {

        Route::get('/services' , [Service::class , 'services']);
        Route::post('/search/services' , [Service::class , 'searchServices']);
        //bookings
        Route::get('/book/{service}/service' , [Booking::class , 'bookingForService']);
        Route::post('/book/trip' , [Booking::class , 'bookTrip']);
        Route::get('/select-seat/{schedule_id}' ,[Booking::class, 'selectSeat']);
        Route::post('/seat/selector_tracker',[Booking::class , 'selectorTracker']);

        // The route that the button calls to initialize payment
        Route::post('/pay', [Payment::class, 'initialize'])->name('pay');

    });







    Route::get('search/bus', function(Illuminate\Http\Request $request){
        $keyword = $request->input('search_bus');
        Log::info($keyword);
        $buses = DB::table('buses')->where('car_type','like','%'.$keyword.'%')
            ->select('buses.id','buses.car_type','car_registration')
            ->get();
        return json_encode($buses);
    })->name('api.search_bus');

});
//
