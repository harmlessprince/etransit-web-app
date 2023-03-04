<?php

use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\AuthorizationConsole;
use App\Http\Controllers\Eticket\CarHireMgt;
use App\Http\Controllers\BoatCruise;
use App\Http\Controllers\Booking;
use App\Http\Controllers\Car;
use App\Http\Controllers\Customer;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Eticket\AuthLogin;
use App\Http\Controllers\Eticket\Driver;
use App\Http\Controllers\Eticket\EticketLocation;
use App\Http\Controllers\Eticket\EticketManifest;
use App\Http\Controllers\Eticket\EticketSchedule;
use App\Http\Controllers\Eticket\EticketTerminal;
use App\Http\Controllers\Eticket\ManageBus;
use App\Http\Controllers\Eticket\ManageDriver;
use App\Http\Controllers\Eticket\ManageRoles;
use App\Http\Controllers\Eticket\ManageTransaction;
use App\Http\Controllers\Eticket\StaffMgt;
use App\Http\Controllers\Eticket\TourPackage;
use App\Http\Controllers\Ferry;
use App\Http\Controllers\FerryBookings;
use App\Http\Controllers\Login;
use App\Http\Controllers\Manifest;
use App\Http\Controllers\Operator;
use App\Http\Controllers\Page;
use App\Http\Controllers\Parcel;
use App\Http\Controllers\ParcelMgt;
use App\Http\Controllers\PartnerDriver;
use App\Http\Controllers\Payment;
use App\Http\Controllers\RoleMgt;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\Tour;
use App\Http\Controllers\Train;
use App\Http\Controllers\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Schedule;
use App\Http\Controllers\Terminal;
use App\Http\Controllers\Transaction;
use App\Http\Controllers\Vehicle;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\NewsletterController;



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
Auth::routes(['verify' => true]);
//normal  user routes
Route::get('/', [Page::class ,'index'])->name('home');

Route::get('test/pdf' , function(){

    $time = strtotime('2022-08-15');

$newformat = date('Y-m-d',$time);
return $newformat ;
    // return view('pdf.test-pdf');
});

//Route::get('/login',[Login::class , 'login']);
//Route::get('/register',[Login::class, 'register']);
// The callback url after a payment
Route::get('/rave/callback', [Payment::class, 'callback'])->name('callback');
Route::post('/bus/bookings/' , [Booking::class , 'bookingRequest'])->name('bus.booking');
Route::post('/bus/filter-bookings/{operator?}/{bus_type?}' , [Booking::class , 'bookingFilterRequest'])->name('filter-bus');

Route::get('filter-cars/{seat_capacity?}/{class_type?}',[Car::class , 'carList']);

Route::get('/about', [PagesController::class, 'about'])->name('about-us');
Route::get('/terms', [PagesController::class, 'terms'])->name('terms');
Route::get('/policy', [PagesController::class, 'policy'])->name('policy');
Route::get('/contact', [PagesController::class, 'contact']);

//post subscribser email
Route::post('/add_subscriber_email', [NewsletterController::class, 'addSubscriber']);

//Auth::routes();

Route::get('/car-hire/{seat_capacity?}/{class_type?}', [Car::class , 'carList']);
//boat cruise
Route::get('/boat-cruise',[BoatCruise::class , 'boatCruiseList']);
//add boat id later on
Route::get('/boat-cruise/{id}/show',[BoatCruise::class , 'boatCruiseShow']);

//tours packages
Route::get('/tour-packages', [Tour::class , 'tourPackageList']);
Route::get('/tour-packages/{tour_id}/show', [Tour::class , 'tourPackageShow']);
Route::get('tour-packages/filter',[Tour::class , 'filterTourSearch'])->name('filter-tour');
Route::get('boats-cruise/filter',[BoatCruise::class , 'filterBoatTripSearch'])->name('filter-boat');


//manage parcel
Route::get('parcel' , [ParcelMgt::class , 'parcel']);
Route::get('/pick-up-city/{state_id}', [ParcelMgt::class ,'fetchCities']);

Route::get('login/{provider}', [SocialController::class ,'redirect']);
Route::get('login/{provider}/callback',[SocialController::class ,'Callback']);

//ferry post
Route::match(array('GET','POST'),'/ferry/bookings' , [FerryBookings::class ,'bookFerry']);
Route::get('ferry/booking/filter',[FerryBookings::class ,'ferryBookingFilter']);

//train bookings
Route::post('train/bookings',[Train::class ,'checkSchedule']);
Route::post('train/bookings/filter',[Train::class ,'checkScheduleFilter']);
//Route::get('train/seat-picker/{schedule_id}/{tripType}', [Train::class , 'trainSeatPicker'])->middleware('auth');


//partner page
Route::get('partners',[\App\Http\Controllers\Partner::class ,'partnerPage']);
Route::get('partners/driver', [\App\Http\Controllers\Partner::class ,'driverPartnerPage']);
Route::get('partners/drivers/', [\App\Http\Controllers\Partner::class ,'driverPartnerPage']);
Route::post('store/become-partners',[\App\Http\Controllers\Partner::class , 'becomePartners']);
Route::post('partners/driver/register',[\App\Http\Controllers\Partner::class , 'registerDriverApplication']);
Route::get('/admin/export-transaction', [Transaction::class , 'exportCsv']);

//NYSC page
Route::get('nysc',[\App\Http\Controllers\Vehicle::class ,'NyscHome']);

//tracker Route

Route::get('authorization/page',[AuthorizationConsole::class , 'authorizeTrustee']);
Route::post('send/authorization/request',[AuthorizationConsole::class ,'AcceptAuthorizationRequest']);
Route::get('tracker/{tracker_id}/user/{transaction_id?}',[\App\Http\Controllers\TrackingConsole::class , 'trackingPage'])->middleware('request_authorization_pin');


//check PDF
Route::get('check-pdf' , function(){
   return view('pdf.boat-cruise');
});

Route::group(['middleware' => ['auth','prevent-back-history','verified']], function() {


    Route::get('profile/{user_id}',[UserProfile::class ,'myProfile'])->name('myProfile');

    Route::put('update-user-profile/{user_id}' ,[UserProfile::class ,'updateUserProfile']);
    Route::get('get-transactions' , [UserProfile::class , 'getMyTransactions']);
    Route::get('view-user-transaction/{transaction_id}/' , [UserProfile::class , 'myTransactions']);

    Route::get('/seat-picker/{schedule_id}/{trip_type}', [Booking::class, 'seatSelector']);

    Route::post('/seat-selector-tracker/',[Booking::class ,'selectorTracker'])->name('select-seat');

    Route::post('/deselect-seat' ,[Booking::class , 'deselectSeat'])->name('de-select-seat');

    Route::post('/book/trip/{schedule_id}/{trip_type}',[Booking::class , 'bookTrip']);

    Route::post('/bus/cash-payment' ,[Booking::class , 'handleBusCashPayment'])->name('bus.pay-cash');
    // The route that the button calls to initialize payment
    Route::post('/pay', [Payment::class, 'initialize'])->name('pay');

    //book a car
    Route::get('select/car-plan/{car_id}' , [Car::class , 'selectPlan']);
    Route::get('/select/plan/{plan_id}/',[Car::class , 'pickPlan']);
    Route::get('/pick-date' ,[Car::class ,'pickDate']);
    Route::post('/plan/{plan_id}',[Car::class , 'proceedToPaymentPlan']);
    Route::get('car-hire/cash/payment/{history_id}/method',[Car::class , 'makePayment']);
    Route::get('view-car-details/{car_id}' , [Car::class , 'carDetails']);


    //select payment plan for boat cruise
    Route::post('/boat-cruise/{boat_id}/payment-plan/{service_id}',[BoatCruise::class , 'addPayment']);
    //make cash payment
    Route::post('/boat-cruise/cash-payment', [BoatCruise::class , 'addCashPayment'])->name('boat-cruise.pay-cash');

    //add tour payment
    Route::post('/tour/{tour_id}/payment-plan/{service_id}',[Tour::class , 'addPayment']);
    Route::post('/tour/cash-payment', [Tour::class , 'addCashPaymentTour'])->name('tour.pay-cash');

    //send parcel info
    Route::post('send-parcel-info', [ParcelMgt::class ,'sendParcel']);
    Route::post('parcel-cash-payment' , [ParcelMgt::class , 'handleCashPayment'])->name('parcel-cash-payment');

    //book ferry
    Route::get('view-ferry-seats/{ferry_trip_id}/{tripType}',[FerryBookings::class , 'selectFerrySeat']);
    Route::post('select-ferry-seat' , [FerryBookings::class , 'FerrySelectorTracker'])->name('select-ferry-seat');
    Route::post('de-select-ferry-seat',[FerryBookings::class ,'deselectFerrySeat'])->name('de-select-ferry-seat');
    Route::post('add-passenger-seat', [FerryBookings::class ,'bookTripForFerryPassenger'])->name('add-passenger-seat');
    Route::post('ferry-cash-payment' ,[FerryBookings::class , 'handleFerryCashPayment']);

    //train
    Route::get('train/seat-picker/{schedule_id}/{train_id}/{tripType}/', [Train::class , 'trainSeatPicker']);
    Route::post('book/train/trip/{schedule_id}',[Train::class , 'passengerDetails']);
    Route::post('train/select-seat',[Train::class , 'selectSeat'])->name('train.select-seat');
    Route::post('train/de-select-seat',[Train::class ,'DeselectSeat'])->name('train.de-select-seat');
    Route::post('train/cash-payment',[Train::class , 'handleCashPayment']);

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

    Route::group(['middleware' => ['admin','prevent-back-history','permissions']], function() {

        Route::get('/dashboard', [Dashboard::class, 'dashboard'])->name('dashboard');



        //vehicle management
        Route::get('/manage/vehicle', [Vehicle::class, 'manage'])->name('manage.vehicle');
        Route::get('/manage/tenant-bus' , [Vehicle::class , 'tenantBus'])->name('manage.bus');
        Route::get('manage/fetch-all-buses' , [Vehicle::class , 'fetchAllTenantBus'])->name('manage-fetch-all-buses');
        Route::get('manage/view-tenant-bus/{bus_id}' , [Vehicle::class , 'viewTenantBus'])->name('view.bus');
        Route::get('manage/delete-tenant-bus/{bus_id}' , [Vehicle::class , 'deleteTenantBus'])->name('delete.bus');
        Route::get('view-bus/{bus_id}' , [Vehicle::class , 'busSchedule'])->name('bus.schedules');
        Route::get('view-bus-schedule/{bus_id}' , [Vehicle::class , 'busScheduleFetch'])->name('view-bus-schedule');
        Route::get('view-bus-schedule-page/{schedule_id}' , [Vehicle::class , 'viewBusSchedulePage']);
        Route::get('edit-bus/{bus_id}',[Vehicle::class ,'editBus']);
        Route::put('update-bus/{bus_id}',[Vehicle::class , 'updateBus']);
        Route::get('manage/bus-type', [Vehicle::class , 'allBusTypes']);
        Route::get('add/bus-type', [Vehicle::class , 'addBusType']);
        Route::post('store-bus-tye', [Vehicle::class , 'storeBusType']);
        Route::get('bus-type-fetch' , [Vehicle::class , 'busTypeFetch'])->name('fetch-bus-types');
        Route::get('update/bus-type/{bus_type_id}' , [Vehicle::class , 'EditBusType']);
        Route::put('update/{bus_type_id}/bus-type' , [Vehicle::class , 'updateBusType']);
        Route::get('manage/bus-destination',[Vehicle::class , 'destinations']);
        Route::get('add/bus-locations',[Vehicle::class , 'addBusLocation']);
        Route::post('store-bus-location' ,[Vehicle::class , 'storeBusLocation']);
        Route::get('fetch-all-bus-location' ,[Vehicle::class , 'fetchBusLocation'])->name('fetch_bus_location');
        Route::get('update/bus-location/{location_id}', [Vehicle::class , 'updateBusLocation']);
        Route::get('delete/bus-location/{location_id}', [Vehicle::class , 'deleteBusLocation']);
        Route::put('edit-bus-location/{location_id}' , [Vehicle::class , 'editVehicleLocation']);



         //nysc vehicle management
         Route::get('/nysc/locations',[Vehicle::class, 'addNyscCamp']);
         Route::post('/nysc/store-camp/',[Vehicle::class, 'storeNyscCamp']);
         Route::get('/nysc/hubs',[Vehicle::class, 'addNyscHub']);
         Route::post('/nysc/store-hub',[Vehicle::class, 'storeNyscHub']);

        //check schedule manifest
        Route::get('schedule-manifest/{schedule_id}', [Manifest::class , 'manifest']);
        Route::get('fetch-bus-manifest/{schedule_id}', [Manifest::class ,'fetchBusManifest'])->name('fetch-bus-manifest');
        Route::get('fetch-passenger-details/{seat_tracker_id}', [Manifest::class , 'fetchPassengerDetails']);



        Route::post('/add/vehicle', [Vehicle::class, 'addVehicle'])->name('add.vehicle');

        //manage terminal
        Route::get('manage/terminals',[Terminal::class , 'Terminals']);
        Route::post('add/terminal',[Terminal::class , 'AddTerminal']);

        //manage bus terminals for tenants
        Route::get('manage/bus-terminals',[Terminal::class , 'allTenantsTerminal']);
        Route::get('fetch-all-tenants-terminal', [Terminal::class , 'fetchTenantsTerminal'])->name('fetch-all-tenants-terminal');
        Route::get('view-terminal/{terminal_id}' ,[Terminal::class ,'viewTerminal']);


        //schedule an event
        Route::get('/event/{bus_id}/schedule' ,[Schedule::class , 'scheduleEvent']);
        Route::post('/schedule/event', [Schedule::class , 'addEvent']);
        //manage transactions
        Route::get('/transactions' , [Transaction::class , 'allTransactions']);
        Route::get('view-transaction/{transaction_id}',[Transaction::class ,'viewTransaction']);
        //aprove transaction
        Route::get('approve-payment/{transaction_id}',[Transaction::class , 'approveTransaction']);
//        Route::get('/export-transaction', [Transaction::class , 'exportCsv']);




        //manage car hiring module route
        Route::get('/manage/cars' , [Car::class ,'allCars']);
        Route::get('manage/car-class' , [Car::class , 'carClass']);
        Route::post('add/car-class' , [Car::class , 'saveCarClass']);
        Route::get('manage/car-type' , [Car::class , 'carType']);
        Route::post('add/car-type' , [Car::class , 'saveCarType']);
        Route::get('view/car/{id}',[Car::class , 'viewTenantCar']);


        Route::get('add/car-hire',[Car::class ,'addCar']);
        Route::post('store/car', [Car::class, 'storeCar']);
        Route::get('/car/{car_id}/history',[Car::class , 'carHistory']);
        Route::get('cars/on-trip',[Car::class , 'onTrip']);
        Route::get('/car/details/{carhistory_id}', [Car::class , 'tripDetails']);


        Route::get('fetch-all-cars',[Car::class ,'fetchAllTenantCars'])->name('fetch-all-cars');

        Route::get('off-trips-car' ,[Car::class , 'offTripCars']);

        Route::get('fetch-off-trip-cars',[Car::class ,'fetchAllOffTripCars'])->name('fetch-off-trip-cars');

        Route::get('on-trips-car' ,[Car::class , 'onTripCars']);

        Route::get('edit/car_class/{id}',[Car::class , 'editCarClass']);
        Route::put('update_car_class/{id}',[Car::class ,'updateCarClass']);

        Route::get('edit/car_type/{id}',[Car::class , 'editCarType']);
        Route::put('update_car_type/{id}',[Car::class ,'updateCarType']);


        //manage boat cruise
        Route::get("/manage/boat-cruise" , [BoatCruise::class , 'index']);
        Route::get('add/boat',[BoatCruise::class ,'addBoat']);
        Route::post('store/boat',[BoatCruise::class ,'storeBoat']);
        Route::get('/manage/boat-schedule/{boat_id}', [BoatCruise::class , 'schedule']);
        Route::post('/schedule/boat-cruise-event',[BoatCruise::class , 'addBoatSchedule'])->name('cruise.event');
        Route::get('manage/boat-location', [BoatCruise::class , 'addCruiseLocation']);
        Route::post('/add/cruise-location', [BoatCruise::class , 'storeCruiseLocation']);

        //boat management
        Route::get('boat/{boat_id}/history',[BoatCruise::class , 'boatHistory']);
        Route::get('/edit/{boat_id}/boat', [BoatCruise::class , 'editBoat']);
        Route::put('/update/{boat_id}/boat' ,[BoatCruise::class , 'updateBoat']);
        Route::get('view-boat-schedules/{boat_id}', [BoatCruise::class , 'viewBoatSchedules']);
        Route::get('view-boat-schedule-payment/{schedule_id}', [BoatCruise::class ,'viewBoatSchedulesPaymentHistory']);

        Route::get('edit/boat_location/{id}',[BoatCruise::class , 'editBoatLocation']);
        Route::put('update_boat_location/{id}',[BoatCruise::class ,'updateBoatLocation']);

        //tour management
        Route::get('manage/tour',[Tour::class , 'manageTour']);
        Route::get('/add/tour',[Tour::class , 'addTour']);
        Route::post('/store/tour',[Tour::class , 'storeTour']);
        Route::get('/tour/{tour_id}/history',[Tour::class , 'history']);
        Route::get('/edit/{tour_id}/tour',[Tour::class , 'editTour']);
        Route::put('/update/tour/{tour_id}',[Tour::class , 'updateTour']);

        //parcel management
        Route::get('/manage/parcel' , [Parcel::class , 'index']);
        Route::post('/add/parcel',[Parcel::class , 'store']);
        Route::get('/parcel/state/index', [Parcel::class , 'stateIndex']);
        Route::post('/parcel/state' , [Parcel::class , 'addState']);
        Route::get('/manage/city' , [Parcel::class , 'addCity']);
        Route::post('/add/city' , [Parcel::class , 'storeCity']);
        Route::get('/manage/height' , [Parcel::class , 'manageHeight']);
        Route::get('/manage/weight' , [Parcel::class , 'manageWeight']);
        Route::get('/manage/length' , [Parcel::class , 'manageLength']);
        Route::get('/manage/width' , [Parcel::class , 'manageWidth']);
        Route::post('/add/dimension/{slug}' , [Parcel::class , 'storeDimension']);
        Route::get('manage/parcel/delivery/request', [Parcel::class ,'parcelDeliveryRequest']);
        Route::get('manage/view-parcel/delivery/request/{delivery_id}', [Parcel::class ,'viewParcelDeliveryRequest']);

        //edit city
        Route::get('/edit-city/{city_id}/parcel' , [Parcel::class , 'editParcelCity']);
        Route::put('/update-city/{city_id}/parcel' , [Parcel::class , 'updateParcelCity']);

        Route::get('/edit-height/{height_id}/parcel' , [Parcel::class , 'editParcelHeight']);
        Route::put('/update-height/{height_id}/parcel' , [Parcel::class , 'updateParcelHeight']);

        Route::get('/edit-length/{length_id}/parcel' , [Parcel::class , 'editParcelLength']);
        Route::put('/update-length/{length_id}/parcel' , [Parcel::class , 'updateParcelLength']);

        Route::get('/edit-weight/{weight_id}/parcel' , [Parcel::class , 'editParcelWeight']);
        Route::put('/update-weight/{weight_id}/parcel' , [Parcel::class , 'updateParcelWeight']);


        Route::get('/edit-width/{width_id}/parcel' , [Parcel::class , 'editParcelWidth']);
        Route::put('/update-width/{width_id}/parcel' , [Parcel::class , 'updateParcelWidth']);

        //ferry management
        Route::get('/manage/ferry',[Ferry::class , 'index']);
        Route::get('/add/ferry',[Ferry::class , 'create']);
        Route::post('/store/ferry' ,[Ferry::class , 'store']);
        Route::get('/ferry/types' , [Ferry::class ,'types']);
        Route::post('/add/ferry-type',[Ferry::class , 'storeFerryType']);
        Route::get('/ferry/schedule-trips/{ferry_id}', [Ferry::class , 'schedule']);
        Route::get('/ferry/locations', [Ferry::class , 'ferryLocations']);
        Route::get('ferry/{ferry_id}/history', [Ferry::class , 'ferryHistory']);
        Route::post('/store/location',[Ferry::class , 'storeLocation']);
        Route::post('/schedule/ferry-event',[Ferry::class , 'scheduleEvent']);
        Route::get('view-ferry-schedules/{ferry_id}',[Ferry::class , 'viewFerryScheduleEvent']);
        Route::get('view-ferry-booking-schedule/{schedule_id}', [Ferry::class , 'viewFerryBookings']);


        Route::get('edit/ferry_type/{id}',[Ferry::class , 'editFerryType']);
        Route::put('update_ferry_type/{id}',[Ferry::class ,'updateFerryType']);

        Route::get('edit/ferry_location/{id}',[Ferry::class , 'editFerryLocation']);
        Route::put('update_ferry_location/{id}',[Ferry::class ,'updateFerryLocation']);

        //manage train
        Route::get('/manage/train'  ,[Train::class , 'index']);
        Route::get('/add/train'     ,[Train::class , 'create']);
        Route::post('/store/train'  ,[Train::class , 'store']);
        Route::get('/train/class'   ,[Train::class ,'trainClassList']);
        Route::post('/store/train-class',[Train::class ,'storeTrainClass']);
        Route::get('/manage/train/location' , [Train::class , 'trainLocation']);
        Route::post('/store/train-state',[Train::class , 'storeTrainState']);
        Route::post('store/train-stops' , [Train::class , 'addEachStop']);
        Route::get('train/{train_id}/history',[Train::class , 'trainHistory']);
        Route::get('/manage/train/schedule/{train_id}', [Train::class , 'manageSchedule']);
        Route::post('/manage/train/schedule', [Train::class , 'ScheduleTrainTrip']);
        Route::get('/manage/train/routes-fare' , [Train::class , 'manageRoute']);
        Route::post('/store/train/routes-fare' , [Train::class , 'storeRoute']);
        Route::get('pick-up-route/{state_id}' , [Train::class , 'fetchStateRoutes']);

        //check RouteFare attached to each schedule
        Route::get('get-route-fares/{train_schedule_id}' , [Train::class , 'fetchRouteFaresForSchedule']);

        //edit train location
        Route::get('edit-train-location/{train_location_id}' , [Train::class , 'editTrainLocation']);
        Route::put('update-train-location/{train_location_id}' , [Train::class , 'updateTrainLocation']);
        Route::delete('delete-train-location/{train_location_id}', [Train::class , 'destroyTrainLocation']);

        //edit train terminal
        Route::get('edit-train-terminal/{terminal_id}', [Train::class , 'EachStopEdit']);
        Route::put('update-train-terminal/{stop_id}',[Train::class , 'updateEachStop']);
        Route::delete('delete-train-terminal/{stop_id}' , [Train::class , 'destroyTrainTerminal']);

        //edit train routes
        Route::get('edit-train-route/{route_id}' , [Train::class , 'editRoute']);
        Route::put('update-train-route/{route_id}', [Train::class , 'updateRoute']);
        Route::delete('delete-train-route/{route_id}', [Train::class , 'destroyRouteFare']);

        //manage Drivers

        Route::get('/manage/drivers',[PartnerDriver::class, 'drivers']);
        Route::get('/manage/drivers/fetch-drivers', [PartnerDriver::class, 'fetchDrivers'])->name('fetch-drivers');
        Route::get('/manage/drivers/{driver_id}',[PartnerDriver::class, 'driverDetails']);
        Route::get('/add/drivers',[PartnerDriver::class, 'onboardDriver']);
        Route::post('/store/driver',[PartnerDriver::class, 'StoreOnboardDriver']);
        Route::post('drivers/edit-rate',[PartnerDriver::class, 'editRate'])->name('set-drivers-rate');


        //manage customer
        Route::get('/customers',[Customer::class , 'customerIndex']);
        Route::get('/customer/list', [Customer::class , 'customers'])->name('customers.list');
        Route::get('/add/customer', [Customer::class, 'addCustomer']);
        Route::post('store-customer', [Customer::class, 'storeCustomer']);
        Route::get('/customer/{customer_id}', [Customer::class , 'getCustomer']);
        Route::get('suspend-user/{customer_id}' , [Customer::class , 'suspendUser']);
        Route::get('activate-user/{customer_id}' , [Customer::class , 'activateUser']);
        Route::get('view-customer-transaction/{customer_id}' , [Customer::class , 'customerTransaction']);
        Route::get('fetch-customer-transaction-history/{customer_id}' , [Customer::class , 'fetchCustomerTransaction']);

        //manage operators
        Route::get('manage/operators',[Operator::class , 'operators']);
        Route::get('create-new-operator',[Operator::class , 'createOperator']);
        Route::post('store-operator',[Operator::class , 'storeOperator']);
        Route::get('fetch-tenants' ,[Operator::class ,'fetchOperators'])->name('fetch-tenants');
        Route::get('view-operator/{id}' , [Operator::class , 'viewOperator']);
        Route::get('operator/{operator_id}',[Operator::class , 'editOperator']);
        Route::put('update-operator/{operator_id}',[Operator::class , 'updateOperator']);
        Route::get('get-operator-users/{id}',[Operator::class , 'fetchOperatorUser'])->name('get-operator-users');
        Route::get('operator-generate-password/{id}',[Operator::class , 'regeneratePassword']);
        Route::post('add-service-to-tenant' , [Operator::class ,'addServiceToOperator'])->name('add-service-to-tenant');
        Route::post('add-permissions-to-role',[RoleMgt::class ,'assignPermissionToRole']);

        //roles and permissions
        Route::get('roles' ,[RoleMgt::class , 'allRoles']);
        Route::get('create-new-role',[RoleMgt::class , 'createNewRole']);
        Route::post('store-role',[RoleMgt::class , 'storeRole']);
        Route::get('fetch-roles',[RoleMgt::class ,'fetchRoles'])->name('fetch-roles');
        Route::get('edit-role/{id}',[RoleMgt::class , 'editRole']);
        Route::put('update-role/{id}',[RoleMgt::class ,'updateRole']);
        Route::get('view-role/{id}',[RoleMgt::class , 'viewRole']);

        //roles permissions
        Route::get('permissions',[RoleMgt::class , 'allPermissions']);
        Route::get('create-new-permissions',[RoleMgt::class , 'addPermissions']);
        Route::post('store-permission',[RoleMgt::class ,'storePermission']);
        Route::get('fetch-permissions',[RoleMgt::class , 'fetchPermissions'])->name('fetch-permissions');
        Route::get('edit-permission/{id}', [RoleMgt::class , 'editPermission']);
        Route::put('update-permission/{id}',[RoleMgt::class ,'updatePermission']);

        //all become partners
        Route::get('/all-partners', [\App\Http\Controllers\Partner::class , 'partners']);
        Route::get('fetch-all-become-partners', [\App\Http\Controllers\Partner::class ,'fetchBecomePartners'])->name('fetch-all-become-partners');
        Route::get('view-partners/{partner_id}',[\App\Http\Controllers\Partner::class , 'viewPartner']);
        Route::get('enable-partner-as-operator/{partner_id}' , [\App\Http\Controllers\Partner::class , 'enablePartnerAsOperator']);

        //partner drivers
        Route::get('/all-partner-drivers', [\App\Http\Controllers\Partner::class , 'newDrivers']);
        Route::get('fetch-all-driver-applications', [\App\Http\Controllers\Partner::class ,'fetchDriverApplications'])->name('fetch-driver-applications');
        Route::get('/view-partner/driver/{partner_drver_id}',[\App\Http\Controllers\Partner::class , 'viewDriver']);
        Route::get('/partner/approve-driver/{partner_driver_id}' , [\App\Http\Controllers\Partner::class , 'approveDriverApplication']);

        //switch service on or off
        Route::get('all-services', [\App\Http\Controllers\ServiceManagent::class ,'allServices']);
        Route::post('activate-deactivate-service',[\App\Http\Controllers\ServiceManagent::class ,'activateOrDeactivateService']);

        Route::get('all/tracking',[\App\Http\Controllers\TrackingConsole::class , 'allTracking']);
        Route::get('view-tracking/{tracking_id}',[\App\Http\Controllers\TrackingConsole::class , 'viewEachTracking']);


    });
});


//to manage the tenants

Route::prefix('e-ticket')->name('e-ticket.')->group(function(){

    Route::get('', [AuthLogin::class , 'eticketLogin'])->name('login-page');
//    Route::post('/user',[AuthLogin::class,'fetchUser'])->name('user');
    Route::post('/logout-tenant',[AuthLogin::class , 'logout'] )->name('logout');
    Route::post('/login-tenant' , [AuthLogin::class , 'loginTenant'])->name('login');

    //import and export buses
    Route::get('export/vehicle', [ManageBus::class, 'exportVehicle'])->name('export.vehicle');

    Route::get('import-export-schedule', [EticketSchedule::class, 'importExportViewSchedule']);
    Route::get('export/schedule', [EticketSchedule::class, 'exportSchedule'])->name('export.schedule');
    Route::post('import/e-ticket/schedule', [EticketSchedule::class, 'importSchedule']);
    //->name('import.schedule');


    Route::group(['middleware' => ['e-ticket','prevent-back-history','check-if-session-is-set','tenant_permissions']], function() {

        Route::get('/dashboard' , [AuthLogin::class , 'dashboard'])->name('dashboard');

        //manage bus
        Route::get('/buses' , [ManageBus::class , 'allBuses'])->name('fetch-buses');
        Route::get('fetch-tenant-buses',[ManageBus::class , 'fetchOBuses'])->name('fetch-tenant-buses');
        Route::get('view-tenant-bus/{bus_id}',[ManageBus::class , 'viewBus'])->name('view-tenant-bus');


        Route::get('edit-tenant-bus/{bus_id}',[ManageBus::class , 'editBus'])->name('edit-tenant-bus');
        Route::get('delete-tenant-bus/{bus_id}',[ManageBus::class , 'deleteBus'])->name('delete-tenant-bus');
        Route::put('update-tenant-bus/{bus_id}', [ManageBus::class , 'updateBus']);
        Route::get('add-new-tenant-bus', [ManageBus::class , 'addNewBus']);
        Route::post('post-new-tenant-bus', [ManageBus::class , 'createTenantBus']);
        Route::get('assign-driver/{bus_id}',[ManageBus::class , 'assignDriver']);
        Route::put('assign-driver/{bus_id}',[ManageBus::class , 'assignDriverToBus']);
        Route::get('remove-driver-from-bus/{driver_id}/{bus_id}' ,[ManageBus::class , 'removeDriverFromBus']);

        //bulk import bus
        Route::get('import', [ManageBus::class, 'importExportView']);
        Route::post('import/vehicle', [ManageBus::class, 'importVehicle'])->name('import.vehicle');


        //manage bus drivers
        Route::get('drivers', [Driver::class ,'drivers']);
        Route::get('create-driver' , [Driver::class , 'createDriver']);
        Route::post('new-driver' , [Driver::class , 'storeDriver']);
        Route::get('fetch-tenant-drivers',[Driver::class , 'fetchDrivers'])->name('fetch-tenant-drivers');
        Route::get('edit-tenant-driver/{driver_id}', [Driver::class , 'editDriver']);
        Route::put('update-driver/{driver_id}',[Driver::class , 'updateDriver']);

        //e-ticket terminal
        Route::get('terminals', [EticketTerminal::class , 'allTerminals']);
        Route::get('add-terminal', [EticketTerminal::class , 'addTerminal']);
        Route::post('store-terminal', [EticketTerminal::class , 'storeAddress']);
        Route::get('fetch-tenant-terminal' , [EticketTerminal::class , 'fetchTerminal'])->name('fetch-tenant-terminal');
        Route::get('edit-tenant-terminal/{terminal_id}', [EticketTerminal::class , 'editTerminal']);
        Route::put('update-tenant-terminal/{terminal_id}', [EticketTerminal::class , 'updateTerminal']);
        //NYSC
        Route::get('/nysc/hubs',[EticketTerminal::class, 'addNyscHub']);
        Route::post('/nysc/store-hubs',[EticketTerminal::class, 'storeNyscHub']);


        //manage e-tickets locations
        Route::get('locations' , [EticketLocation::class , 'manageLocations']);
        Route::get('add-location', [EticketLocation::class , 'addLocation']);
        Route::post('store-location',[EticketLocation::class , 'storeLocation']);
        Route::get('fetch-tenant-locations', [EticketLocation::class ,'fetchLocation'])->name('fetch-tenant-locations');
        Route::get('view-tenant-location/{location_id}', [EticketLocation::class , 'viewLocation']);
        Route::get('delete-tenant-location/{location_id}', [EticketLocation::class , 'deleteLocation']);



        //schedule trip for buses
        Route::get('/schedule/{bus_id}',[ManageBus::class , 'scheduleTrip']);
        Route::post('add-eticket-schedule', [EticketSchedule::class , 'addEticketSchedule']);
//        ->name('add-eticket-schedule');
        Route::get('all-scheduled-trip',[EticketSchedule::class , 'allScheduledTrip']);
        Route::get('fetch-scheduled-trip', [EticketSchedule::class, 'fetchAllSchedules'])->name('fetch-scheduled-trip');
        Route::get('view-each-schedule/{schedule_id}' , [EticketSchedule::class , 'viewEachSchedule']);
        Route::get('delete-each-schedule/{schedule_id}' , [EticketSchedule::class , 'deleteEachSchedule']);
        Route::get('view-bus-each-schedule/{bus_id}', [EticketSchedule::class , 'viewBusSchedule']);
        Route::get('view-bus-schedules/{bus_id}', [EticketSchedule::class , 'viewEachBusSchedule'])->name('view-bus-schedules');
        Route::post('update-schedule-status/{schedule_id}',[EticketSchedule::class , 'updateScheduleStatus']);
        //generate seat for  schedules with empty seats
        Route::get('generate-schedule-empty-seat/{schedule_id}',[EticketSchedule::class , 'generateSeatTrackerForScheduleWithEmptySeat']);
        Route::get('global-seat-tracker-settings',[EticketSchedule::class , 'globalSeatTracker']);
        Route::get('generate-all-schedules-empty-seat',[EticketSchedule::class , 'globalSeatGenerator']);


        //check schedule manifest
        Route::get('schedule-manifest/{schedule_id}', [EticketManifest::class , 'manifest']);
        Route::get('fetch-bus-manifest/{schedule_id}', [EticketManifest::class ,'fetchBusManifest'])->name('fetch-bus-manifest');
        Route::get('fetch-passenger-details/{seat_tracker_id}', [EticketManifest::class , 'fetchPassengerDetails']);

        //add passengers to schedule
        Route::get('add-passenger/{schedule_id}',[EticketManifest::class, 'addPassenger']);
        Route::post('add-passengers/{schedule_id}/{trip_type}',[EticketManifest::class, 'addPassengers'])->name('add-passengers');
        //select seats
        Route::post('/seat-selector-tracker',[EticketManifest::class ,'selectorTracker'])->name('select-seat');

        Route::post('/deselect-seat' ,[EticketManifest::class , 'deselectSeat'])->name('deselect-seat');

        Route::get('/printreceipt/{invoiceId}',[EticketManifest::class, 'printTicket']);

        //manage staffs
        Route::get('staffs' , [StaffMgt::class , 'allStaff']);
        Route::get('fetch-tenant-staffs', [StaffMgt::class , 'fetchStaffs'])->name('fetch-tenant-staffs');
        Route::get('create-staff' , [StaffMgt::class , 'createStaff']);
        Route::post('store-staff' , [StaffMgt::class , 'storeStaff']);
        Route::get('store-edit/{staff_id}' , [StaffMgt::class , 'editStaff']);
        Route::put('store-update/{staff_id}', [StaffMgt::class , 'updateStaff']);
        Route::get('view-staff/{staff_id}', [StaffMgt::class , 'viewStaff']);
        Route::get('terminate/{staff_id}/appointment',[StaffMgt::class ,'terminateAppointment']);
        Route::get('enable/{staff_id}/appointment',[StaffMgt::class ,'enableAppointment']);
        Route::get('assign-role/{staff_id}/',[StaffMgt::class ,'assignRole'])->name('assign-role');
        Route::post('assign-staff-to-role/{staff_id}',[StaffMgt::class ,'assignUserRole'])->name('add-role');


        //mage car hire routes
        Route::get('car-hire' , [CarHireMgt::class , 'allCars'])->name('all-cars');
        Route::get('add-car' , [CarHireMgt::class , 'createCars'])->name('create-car');

        Route::post('store-car' ,[CarHireMgt::class ,'storeCar'])->name('store-car');
        Route::get('fetch-hired-cars',[CarHireMgt::class , 'fetchHiredCars'])->name('view-all-cars');

        Route::get('edit-car/{car_id}', [CarHireMgt::class , 'editCar'])->name('edit-car');
        Route::put('update-tenant-car/{car_id}',[CarHireMgt::class , 'updateCarInformation'])->name('update-car');

        Route::get('edit-car-plan/{car_id}',[CarHireMgt::class ,'editCarPlan'])->name('edit-car-plan');
        Route::put('update-car-plan/{car_id}',[CarHireMgt::class ,'updateCarPlan'])->name('update-car-plan');

        //view car
        Route::get('view-car/{car_id}' ,[CarHireMgt::class , 'viewCar'])->name('view-car');

        Route::get('view-tenant-car-history/{car_id}' ,[CarHireMgt::class , 'viewCarHistories'])->name('view-all-car-history');

        Route::get('view-history/{car_history_id}' , [CarHireMgt::class , 'viewCarHistory'])->name('view-history');

        Route::get('confirm-drop-off/{car_history_id}', [CarHireMgt::class , 'confirmDropOff'])->name('confirm-drop-off');

        Route::get('confirm-pick-up/{car_history_id}', [CarHireMgt::class , 'confirmPickUp'])->name('confirm-pick-up');

        Route::get('mark-as-paid/{car_history_id}',[CarHireMgt::class , 'markAsPaid'])->name('mark-as-paid');

        Route::get('toggle-car-availability/{car_id}',[CarHireMgt::class , 'toggleUnAvailability']);

        Route::get('toggle-car-un-availability/{car_id}',[CarHireMgt::class , 'toggleUnUnAvailability']);

        Route::get('update-car-image/{car_id}',[CarHireMgt::class, 'editCarImage']);
        Route::put('update/{car_id}/car-image',[CarHireMgt::class, 'updateCarImage']);

        //manage driver profile

        Route::get('partner-driver/profile/{driver_id}',[ManageDriver::class, 'driverDetails'])->name('partner-driver-view-profile');
        Route::post('partner-driver/edit-rate',[PartnerDriver::class, 'editRate'])->name('set-drivers-rate');

        //add tour
        Route::get('tour-packages',[TourPackage::class , 'allTours'])->name('all-tours');

        Route::get('fetch-tour-packages',[TourPackage::class , 'fetchTours'])->name('fetch-all-tours');

        Route::get('add-tour',[TourPackage::class , 'addTours'])->name('add-tours');

        Route::post('store-tour',[TourPackage::class ,'storeTour'])->name('store-tours');

        Route::get('view-tour/{tour_id}',[TourPackage::class , 'viewTour'])->name('view-tour');


        //manage roles
        Route::get('roles',[ManageRoles::class , 'roles'])->name('all-roles');
        Route::get('add-new-role',[ManageRoles::class ,'addNewRole'])->name('add-new-role');

        Route::post('store-new-role',[ManageRoles::class ,'storeRole'])->name('store-new-role');

        Route::get('fetch-roles',[ManageRoles::class , 'fetchRoles'])->name('fetch-roles');

        Route::get('view-role/{role_id}', [ManageRoles::class ,'viewRole'])->name('view-role');
        Route::post('add-permissions-to-role', [ManageRoles::class ,'addPermisisonToRole'])->name('add-permission-to-role');

        //transaction
        Route::get('transactions',[ManageTransaction::class , 'allTransactions']);
        Route::get('view-transaction/{transaction_id}',[ManageTransaction::class  ,'viewTransaction']);

        //tracking console
        Route::get('all/tracking',[\App\Http\Controllers\Eticket\TrackingConsole::class , 'allTracking']);
        Route::get('view-tracking/{tracking_id}',[\App\Http\Controllers\Eticket\TrackingConsole::class , 'viewEachTracking']);


    });


});

Route::any('/user-proxy/enter/{id}/{true}', function ($id) {
    request()->session()->put('user-proxy-id', $id);
    return redirect('/');
})->name('impersonate');

// Exit Impersonation Mode
Route::any('/user-proxy/exit', function () {
    request()->session()->remove('user-proxy-id');
    return redirect('/');
})->name('impersonate-exit');
