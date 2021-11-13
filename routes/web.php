<?php

use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\Booking;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Login;
use App\Http\Controllers\Page;
use Illuminate\Support\Facades\Route;


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
Route::get('/', [Page::class ,'index']);

Route::get('/login',[Login::class , 'login']);
Route::get('/register',[Login::class, 'register']);

Route::post('/bus/bookings' , [Booking::class , 'bookingRequest'])->name('bus.booking');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/seat-picker/{schedule_id}', [Booking::class, 'seatSelector']);
    Route::post('/seat-selector-tracker/',[Booking::class ,'selectorTracker']);
    Route::post('/deselect-seat' ,[Booking::class , 'deselectSeat']);
    Route::post('/book/trip/{schedule_id}',[Booking::class , 'bookTrip']);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::any('{slug}' , function(){
//    return view('welcome');
//})->where('any','.*');
