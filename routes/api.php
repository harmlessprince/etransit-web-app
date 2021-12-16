<?php

use App\Http\Controllers\Api\AuthUser;
use App\Http\Controllers\Api\BoatCruise;
use App\Http\Controllers\Api\Booking;
use App\Http\Controllers\Api\Car;
use App\Http\Controllers\Api\Ferry;
use App\Http\Controllers\Api\FlutterwavePayment;
use App\Http\Controllers\Api\Parcel;
use App\Http\Controllers\Api\Partner;
use App\Http\Controllers\Api\PasswordReset;
use App\Http\Controllers\Api\Payment;
use App\Http\Controllers\Api\Profile;
use App\Http\Controllers\Api\Service;
use App\Http\Controllers\Api\Tour;
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

//    store partners
    Route::post('/partners/create' , [Partner::class , 'store']);
    Route::post('/rave/callback/', [FlutterwavePayment::class, 'callback'])->name('api.callback');



//    Route::middleware('jwt.verify')->group( function () {
    Route::group(['middleware' => ['jwt.verify']], function () {
        Route::get('/services' , [Service::class , 'services']);
        Route::post('/search/services' , [Service::class , 'searchServices']);
        //bookings
        Route::get('/book/{service}/service' , [Booking::class , 'bookingForService']);
        Route::post('/book/trip' , [Booking::class , 'bookTrip']);
        Route::get('/select-seat/{schedule_id}' ,[Booking::class, 'selectSeat']);
        Route::post('/seat/selector_tracker',[Booking::class , 'selectorTracker']);
        Route::post('/deselect-seat',[Booking::class , 'deselectSeat']);
        Route::post('passenger/info/{schedule_id}',[Booking::class ,'bookTripForPassenger']);
        // The route that the button calls to initialize payment
        Route::post('/pay', [Payment::class, 'initialize'])->name('pay');
        //profile update
        Route::get('/get-user-profile',[Profile::class,'getUserProfile']);
        Route::post('/profile/update',[Profile::class,'profileUpdate']);

        Route::post('/initialise-pay', [FlutterwavePayment::class, 'initialize'])->name('api.pay.flutter');

        //car hiree endpoint
        Route::get('/car/types',[Car::class , 'CarType']);
        Route::get('/car/class' , [Car::class , 'carClass']);
        Route::get('/select/type/{car_type_id}',[Car::class,'selectCarType']);
        Route::get('/select/class/{car_class_id}/{selected_car_type_id}',[Car::class,'selectCarClass']);
        Route::get('/fetch/car-list/{car_type_id}/{car_class_id}' , [Car::class , 'carList']);
        Route::get('/car/{car_id}/plan' , [Car::class , 'selectPlan']);
        Route::get('/pick-car-plan/{plan_id}' , [Car::class , 'pickPlan']);
        Route::post('/book-date/{plan_id}' ,[Car::class,'bookADate']);
        Route::get('/car-hire/handle-cash-payment/{history_id}' ,[Car::class,'makeCashPayment']);

        //boat cruise api
        Route::get('/boat-cruise',[BoatCruise::class , 'boatCruiseList']);
        Route::get('/boat-cruise/{trip_id}/show',[BoatCruise::class , 'boatCruiseShow']);
        Route::post('/boat-cruise/{trip_id}/payment-plan/{service_id}',[BoatCruise::class , 'addPayment']);
        //cash payment option
        Route::post('/boat-cruise/cash-payment', [BoatCruise::class , 'addCashPayment'])->name('boat-cruise.pay-cash');

        //tour packages
        Route::get('/tour-packages', [Tour::class , 'tourPackageList']);
        Route::get('/tour-packages/{tour_id}/show/{service_id}', [Tour::class , 'tourPackageShow']);

        //add tour payment options
        Route::post('/tour/{tour_id}/payment-plan/{service_id}',[Tour::class , 'addPayment']);
        Route::post('/tour/cash-payment', [Tour::class , 'addCashPaymentTour'])->name('tour.pay-cash');

        //send parcel
        Route::get('/parcel' , [Parcel::class , 'fetchParcel']);
        Route::get('fetch-states' , [Parcel::class , 'fetchStates']);
        Route::get('/fetch-cities/{state_id}',[Parcel::class , 'fetchCities']);
        Route::post('/send-parcel' , [Parcel::class , 'sendParcel']);
        Route::post('/parcel/user-info', [Parcel::class , 'storeUserInfo']);
        Route::post('/parcel-cash-payment' , [Parcel::class , 'addCashPayment']);

        //ferry
        Route::get('/ferry-service' , [Ferry::class ,'ferryService']);
        Route::post('/book/ferry' , [Ferry::class , 'bookFerry']);
        Route::get('/ferry-seat/{ferry_trip_id}/{tripType}' , [Ferry::class , 'selectFerrySeat']);
        Route::post('/select/ferry-seat', [Ferry::class , 'FerrySelectorTracker']);
        Route::post('/de-select/ferry-seat' , [Ferry::class , 'deselectFerrySeat']);
        Route::post('/book/ferry-trip/{seat_tracker_id}' , [Ferry::class ,'bookTripForFerryPassenger']);

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
