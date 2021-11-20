<?php

use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\Booking;
use App\Http\Controllers\Car;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Login;
use App\Http\Controllers\Page;
use App\Http\Controllers\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Schedule;
use App\Http\Controllers\Terminal;
use App\Http\Controllers\Transaction;
use App\Http\Controllers\Vehicle;



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
Route::get('/', [Page::class ,'index'])->name('home');

//Route::get('/login',[Login::class , 'login']);
//Route::get('/register',[Login::class, 'register']);
// The callback url after a payment
Route::get('/rave/callback', [Payment::class, 'callback'])->name('callback');
Route::post('/bus/bookings' , [Booking::class , 'bookingRequest'])->name('bus.booking');

Auth::routes();

Route::get('/car-hire', [Car::class , 'carList']);

Route::group(['middleware' => ['auth','prevent-back-history']], function() {
    Route::get('/seat-picker/{schedule_id}', [Booking::class, 'seatSelector']);
    Route::post('/seat-selector-tracker/',[Booking::class ,'selectorTracker']);
    Route::post('/deselect-seat' ,[Booking::class , 'deselectSeat']);
    Route::post('/book/trip/{schedule_id}',[Booking::class , 'bookTrip']);
    // The route that the button calls to initialize payment
    Route::post('/pay', [Payment::class, 'initialize'])->name('pay');

});


Route::prefix('admin')->name('admin.')->group(function(){

    Route::get('' , [AdminLogin::class , 'showLoginForm'])->name('login.page');

    Route::post('/logout-admin',[AdminLogin::class , 'logout'] )->name('logout');
    Route::post('/login-user' , [AdminLogin::class , 'loginAdmin'])->name('login');

    //bulk import buses
    Route::get('import', [Vehicle::class, 'importExportView']);
    Route::get('export/vehicle', [Vehicle::class, 'exportVehicle'])->name('export.vehicle');
    Route::post('import/vehicle', [Vehicle::class, 'importVehicle'])->name('import.vehicle');

    //bulk import terminals
    Route::get('import-terminal', [Terminal::class, 'importExportViewTerminal']);
    Route::get('export/terminal', [Terminal::class, 'exportTerminal'])->name('export.terminal');
    Route::post('import/terminal', [Terminal::class, 'importTerminal'])->name('import.terminal');

    //bulk import hired-cars
    Route::get('import-terminal-cars', [Car::class, 'importExportViewTerminal']);
    Route::get('export/cars', [Car::class, 'exportCar'])->name('export.car');
    Route::post('import/car', [Terminal::class, 'importCar'])->name('import.car');


    Route::group(['middleware' => ['admin','prevent-back-history']], function() {

        Route::get('/dashboard', [Dashboard::class, 'dashboard'])->name('dashboard');
        //vehicle management
        Route::get('/manage/vehicle', [Vehicle::class, 'manage'])->name('manage.vehicle');
        Route::post('/add/vehicle', [Vehicle::class, 'addVehicle'])->name('add.vehicle');

        //manage terminal
        Route::get('manage/terminals',[Terminal::class , 'Terminals']);
        Route::post('add/terminal',[Terminal::class , 'AddTerminal']);

        //schedule an event
        Route::get('/event/{bus_id}/schedule' ,[Schedule::class , 'scheduleEvent']);
        Route::post('/schedule/event', [Schedule::class , 'addEvent']);

        //manage transactions
        Route::get('/transactions' , [Transaction::class , 'allTransactions']);

        //manage car hiring module route
        Route::get('/manage/cars' , [Car::class ,'allCars']);
        Route::post('add/cars', [Car::class, 'addCars']);
        Route::get('/car/{car_id}/history',[Car::class , 'carHistory']);

    });
});

