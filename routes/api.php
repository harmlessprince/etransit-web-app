<?php

use App\Http\Controllers\Api\AuthUser;
use App\Http\Controllers\Api\Booking;
use App\Http\Controllers\Api\Partner;
use App\Http\Controllers\Api\PasswordReset;
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
    //store partners
    Route::post('/partners/create' , [Partner::class , 'store']);


    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('/services' , [Service::class , 'services']);
        Route::post('/search/services' , [Service::class , 'searchServices']);

        //bookings
        Route::get('/book/{service}/service' , [Booking::class , 'bookingForService']);
        Route::post('/book/trip' , [Booking::class , 'bookTrip']);
    });

});
//
