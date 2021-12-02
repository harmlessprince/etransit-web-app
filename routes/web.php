<?php

use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\BoatCruise;
use App\Http\Controllers\Booking;
use App\Http\Controllers\Car;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Eticket\AuthLogin;
use App\Http\Controllers\Login;
use App\Http\Controllers\Page;
use App\Http\Controllers\Payment;
use App\Http\Controllers\Tour;
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

//normal  user routes
Route::get('/', [Page::class ,'index'])->name('home');

//Route::get('/login',[Login::class , 'login']);
//Route::get('/register',[Login::class, 'register']);
// The callback url after a payment
Route::get('/rave/callback', [Payment::class, 'callback'])->name('callback');
Route::post('/bus/bookings' , [Booking::class , 'bookingRequest'])->name('bus.booking');

Auth::routes();

Route::get('/car-hire', [Car::class , 'carList']);
//boat cruise
Route::get('/boat-cruise',[BoatCruise::class , 'boatCruiseList']);
//add boat id later on
Route::get('/boat-cruise/show',[BoatCruise::class , 'boatCruiseShow']);

//tours packages
Route::get('/tour-packages', [Tour::class , 'tourPackageList']);
Route::get('/tour-packages/show', [Tour::class , 'tourPackageShow']);

Route::group(['middleware' => ['auth','prevent-back-history']], function() {

    Route::get('/seat-picker/{schedule_id}', [Booking::class, 'seatSelector']);
    Route::post('/seat-selector-tracker/',[Booking::class ,'selectorTracker']);
    Route::post('/deselect-seat' ,[Booking::class , 'deselectSeat']);
    Route::post('/book/trip/{schedule_id}',[Booking::class , 'bookTrip']);
    // The route that the button calls to initialize payment
    Route::post('/pay', [Payment::class, 'initialize'])->name('pay');

    //book a car
    Route::get('select/car-plan/{car_id}' , [Car::class , 'selectPlan']);
    Route::get('/select/plan/{plan_id}/',[Car::class , 'pickPlan']);
    Route::get('/pick-date' ,[Car::class ,'pickDate']);
    Route::post('/plan/{plan_id}',[Car::class , 'proceedToPaymentPlan']);
    Route::get('car-hire/cash/payment/{history_id}/method',[Car::class , 'makePayment']);


});


//admin routes only
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
    Route::get('import-export-cars', [Car::class, 'importExportViewCars']);
    Route::get('export/cars', [Car::class, 'exportCar'])->name('export.car');
    Route::post('import/cars', [Car::class, 'importCars'])->name('import.car');
    //bulk import schedule
    Route::get('import-export-schedule', [Schedule::class, 'importExportViewSchedule']);
    Route::get('export/schedule', [Schedule::class, 'exportSchedule'])->name('export.schedule');
    Route::post('import/schedule', [Schedule::class, 'importSchedule'])->name('import.schedule');

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
        Route::get('manage/car-class' , [Car::class , 'carClass']);
        Route::post('add/car-class' , [Car::class , 'saveCarClass']);
        Route::get('manage/car-type' , [Car::class , 'carType']);
        Route::post('add/car-type' , [Car::class , 'saveCarType']);

        Route::get('add/car-hire',[Car::class ,'addCar']);
        Route::post('store/car', [Car::class, 'storeCar']);
        Route::get('/car/{car_id}/history',[Car::class , 'carHistory']);
        Route::get('cars/on-trip',[Car::class , 'onTrip']);
        Route::get('/car/details/{carhistory_id}', [Car::class , 'tripDetails']);

    });
});


//to manage the tenants

Route::prefix('e-ticket')->name('e-ticket.')->group(function(){

    Route::get('', [AuthLogin::class , 'eticketLogin'])->name('login-page');
    Route::post('/user',[AuthLogin::class,'fetchUser'])->name('user');
    Route::post('/logout-tenant',[AuthLogin::class , 'logout'] )->name('logout');
    Route::post('/login-tenant' , [AuthLogin::class , 'loginTenant'])->name('login');

    Route::group(['middleware' => ['tenant','prevent-back-history']], function() {
        Route::get('/dashboard' , [AuthLogin::class , 'dashboard'])->name('dashboard');
    });


});
