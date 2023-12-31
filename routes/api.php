<?php

use App\Http\Controllers\Api\Payment;
use App\Http\new_Controllers\Api\AuthUser;
use App\Http\new_Controllers\Api\BoatCruise;
use App\Http\Controllers\Api\Booking;
use App\Http\Controllers\Api\Car;
use App\Http\Controllers\Api\EmailVerify;
use App\Http\Controllers\Api\Ferry;
use App\Http\Controllers\Api\FlutterwavePayment;
use App\Http\Controllers\Api\Parcel;
use App\Http\new_Controllers\Api\Partner;
use App\Http\Controllers\Api\PasswordReset;
use App\Http\Controllers\Api\Profile;
use App\Http\Controllers\Api\Service;
use App\Http\Controllers\Api\SocialController;
use App\Http\Controllers\Api\Tour;
use App\Http\Controllers\Api\TrackingConsole;
use App\Http\Controllers\Api\Train;
use App\Http\Controllers\Api\Transaction;
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
    Route::post('verify-email',[EmailVerify::class ,'verifyEmail']);
    Route::post('resend-verify-token',[EmailVerify::class , 'resendEmailVerifyToken']);

    Route::get('login/{provider}', [SocialController::class ,'redirect']);
    Route::get('login/{provider}/callback',[SocialController::class ,'callback']);
    //accept token for Google auth
    Route::post('accept-token-google-signup',[SocialController::class , 'acceptToken']);

//    store partners
    Route::post('/partners/create' , [Partner::class , 'store']);
//    Route::get('/rave/callback/', [FlutterwavePayment::class, 'callback'])->name('api.callback');
    Route::post('/rave/callback/', [FlutterwavePayment::class, 'callback'])->name('api.callback');

    Route::get('/services' , [Service::class , 'services']);
    Route::post('/search/services' , [Service::class , 'searchServices']);
    //bookings
    Route::get('/book/{service}/service' , [Booking::class , 'bookingForService']);
    Route::post('/book/trip' , [Booking::class , 'bookTrip']);
    Route::post('/bus/filter-bookings/' , [Booking::class , 'bookingFilterRequest'])->name('filter-bus');

    //car hiree endpoint
    Route::get('/car/types',[Car::class , 'CarType']);
    Route::get('/car/class' , [Car::class , 'carClass']);
    Route::get('/select/type/{car_type_id}',[Car::class,'selectCarType']);
    Route::get('/select/class/{car_class_id}/{selected_car_type_id}',[Car::class,'selectCarClass']);
    Route::get('/fetch/car-list/{car_type_id}/{car_class_id}' , [Car::class , 'carList']);

    //boat cruise api
    Route::get('/boat-cruise',[BoatCruise::class , 'boatCruiseList']);
    Route::get('/boat-cruise/{trip_id}/show',[BoatCruise::class , 'boatCruiseShow']);

    //tour packages
    Route::get('/tour-packages', [Tour::class , 'tourPackageList']);
    Route::get('/tour-packages/{tour_id}/show/{service_id}', [Tour::class , 'tourPackageShow']);

    //send parcel
    Route::get('/parcel' , [Parcel::class , 'fetchParcel']);
    Route::get('fetch-states' , [Parcel::class , 'fetchStates']);
    Route::get('/fetch-cities/{state_id}',[Parcel::class , 'fetchCities']);

    //ferry
    Route::get('/ferry-service' , [Ferry::class ,'ferryService']);
    Route::post('/book/ferry' , [Ferry::class , 'bookFerry']);

    //train module
    Route::get('/train-bookings' , [Train::class , 'bookTrain']);
    Route::post('/check/train-schedule', [Train::class , 'checkSchedule']);


    Route::post('record-active/tracking/{tracker_id}',[TrackingConsole::class,'recordActiveTracking']);

//    Route::middleware('jwt.verify')->group( function () {
    Route::post('delete/user/{id}', [AuthUser::class, 'deleteUser']);
    Route::group(['middleware' => ['jwt.verify','is_banned','must_verify']], function () {

         //bus booking
        Route::get('/select-seat/{schedule_id}/{trip_type}' ,[Booking::class, 'selectSeat']);
        Route::post('/seat/selector_tracker',[Booking::class , 'selectorTracker']);
        Route::post('/deselect-seat',[Booking::class , 'deselectSeat']);
        Route::post('passenger/info/{schedule_id}/{trip_type}',[Booking::class ,'bookTripForPassenger']);
        // The route that the button calls to initialize payment
        Route::post('/pay', [Payment::class, 'initialize'])->name('pay');
        Route::post('/bus/handle-cash-payment' ,[Booking::class , 'handleBusCashPayment'])->name('bus.handle-pay-cash');
        //profile update
        Route::get('/get-user-profile',[Profile::class,'getUserProfile']);
        Route::post('/profile/update',[Profile::class,'profileUpdate']);

        Route::post('/initialise-pay', [FlutterwavePayment::class, 'initialize'])->name('api.pay.flutter');

        //car hire module
        Route::get('/car/{car_id}/plan' , [Car::class , 'selectPlan']);
        Route::get('/pick-car-plan/{plan_id}' , [Car::class , 'pickPlan']);
        Route::post('/book-date/{plan_id}' ,[Car::class,'bookADate']);
        Route::get('/car-hire/handle-cash-payment/{history_id}' ,[Car::class,'makeCashPayment']);
        Route::get('/fetch-hired-car/state' ,[Car::class,'fetchCarState']);

        // boat cruise module
        Route::post('/boat-cruise/{trip_id}/payment-plan/{service_id}',[BoatCruise::class , 'addPayment']);
        //cash payment option
        Route::post('/boat-cruise/cash-payment', [BoatCruise::class , 'addCashPayment'])->name('boat-cruise.pay-cash');


         //tour packages module
        //add tour payment options
        Route::post('/tour/{tour_id}/payment-plan/{service_id}',[Tour::class , 'addPayment']);
        Route::post('/tour/cash-payment', [Tour::class , 'addCashPaymentTour'])->name('tour.pay-cash');

        //send parcel module
        Route::post('/send-parcel' , [Parcel::class , 'sendParcel']);
        Route::post('/parcel/user-info', [Parcel::class , 'storeUserInfo']);
        Route::post('/parcel-cash-payment' , [Parcel::class , 'addCashPayment']);

        //fery booking module
        Route::get('/ferry-seat/{ferry_trip_id}/{tripType}' , [Ferry::class , 'selectFerrySeat']);
        Route::post('/select/ferry-seat', [Ferry::class , 'FerrySelectorTracker']);
        Route::post('/de-select/ferry-seat' , [Ferry::class , 'deselectFerrySeat']);
        Route::post('/book/ferry-trip' , [Ferry::class ,'bookTripForFerryPassenger']);
        Route::post('/handle/ferry/cash-payment',[Ferry::class , 'handleFerryCashPayment']);

        //train ticketing module
        Route::get('/train-seat/{train_schedule_id}/{train_id}' , [Train::class , 'trainSeat']);
        Route::post('/train-select-seat', [Train::class , 'selectSeat']);
        Route::post('/train-de-select-seat', [Train::class , 'DeselectSeat']);
        Route::get('/train-route/selector/{train_schedule_id}' , [Train::class , 'routeSelector']);
        Route::post('/train/add-passenger-details' , [Train::class , 'passengerDetails']);
        Route::post('/train/handle-cash-payment' , [Train::class , 'handleCashPayment']);

        //fetch user transaction
        Route::get('my-transactions' , [Transaction::class ,'userTransactions']);


        //fetch user transaction
        Route::get('next-of-kin' , [Transaction::class ,'nextOfKin']);

        Route::get('tracker/{tracking_id}' , [Transaction::class ,'getTracker']);

        //track user
        Route::get('prefill_trustee_info/{transaction_id}',[TrackingConsole::class , 'prefillTrusteeInfo']);

        Route::post('initiate-tracking/{transaction_id?}',[TrackingConsole::class , 'trackUser']);

        Route::post('start-tracking',[TrackingConsole::class , 'initiateTracking']);

        //end tracking
        Route::get('end-active-tracking/{tracker_id}',[TrackingConsole::class ,'endActiveTrackingSession']);

        //previous tracking session
        Route::get('previous_tracking_session/{limit?}',[TrackingConsole::class , 'previousTrackingSessions']);
        Route::get('tracking_active_sessions/{limit?}',[TrackingConsole::class , 'activeSessionTracking']);
        Route::get('tracking/{tracker_id}/record/{limit?}',[TrackingConsole::class , 'TrackingRecord']);
        Route::get('fetch-extra-tracking-info/{transaction_id}',[TrackingConsole::class , 'fetchExtraTrackingInfo']);

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
