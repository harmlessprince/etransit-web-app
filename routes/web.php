<?php

use App\Http\Controllers\AdminLogin;
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
use App\Http\Controllers\Eticket\StaffMgt;
use App\Http\Controllers\Ferry;
use App\Http\Controllers\Login;
use App\Http\Controllers\Operator;
use App\Http\Controllers\Page;
use App\Http\Controllers\Parcel;
use App\Http\Controllers\ParcelMgt;
use App\Http\Controllers\Payment;
use App\Http\Controllers\RoleMgt;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\Tour;
use App\Http\Controllers\Train;
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
Route::get('/boat-cruise/{id}/show',[BoatCruise::class , 'boatCruiseShow']);

//tours packages
Route::get('/tour-packages', [Tour::class , 'tourPackageList']);
Route::get('/tour-packages/{tour_id}/show', [Tour::class , 'tourPackageShow']);


//manage parcel
Route::get('parcel' , [ParcelMgt::class , 'parcel']);
Route::get('/pick-up-city/{state_id}', [ParcelMgt::class ,'fetchCities']);

Route::get('login/{provider}', [SocialController::class ,'redirect']);
Route::get('login/{provider}/callback',[SocialController::class ,'Callback']);

//check PDF
Route::get('check-pdf' , function(){
   return view('pdf.boat-cruise');
});

Route::group(['middleware' => ['auth','prevent-back-history']], function() {
//    ,'must_verify'

    Route::get('/seat-picker/{schedule_id}', [Booking::class, 'seatSelector']);
    Route::post('/seat-selector-tracker/',[Booking::class ,'selectorTracker'])->name('select-seat');
    Route::post('/deselect-seat' ,[Booking::class , 'deselectSeat'])->name('de-select-seat');
    Route::post('/book/trip/{schedule_id}',[Booking::class , 'bookTrip']);
    Route::post('/bus/cash-payment' ,[Booking::class , 'handleBusCashPayment'])->name('bus.pay-cash');
    // The route that the button calls to initialize payment
    Route::post('/pay', [Payment::class, 'initialize'])->name('pay');

    //book a car
    Route::get('select/car-plan/{car_id}' , [Car::class , 'selectPlan']);
    Route::get('/select/plan/{plan_id}/',[Car::class , 'pickPlan']);
    Route::get('/pick-date' ,[Car::class ,'pickDate']);
    Route::post('/plan/{plan_id}',[Car::class , 'proceedToPaymentPlan']);
    Route::get('car-hire/cash/payment/{history_id}/method',[Car::class , 'makePayment']);

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
        Route::get('view-bus/{bus_id}' , [Vehicle::class , 'busSchedule'])->name('bus.schedules');
        Route::get('view-bus-schedule/{bus_id}' , [Vehicle::class , 'busScheduleFetch'])->name('view-bus-schedule');
        Route::get('view-bus-schedule-page/{schedule_id}' , [Vehicle::class , 'viewBusSchedulePage']);
        Route::get('edit-bus/{bus_id}',[Vehicle::class ,'editBus']);
        Route::put('update-bus/{bus_id}',[Vehicle::class , 'updateBus']);




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

        //edit city
        Route::get('/edit-city/{city_id}/parcel' , [Parcel::class , 'editParcelCity']);
        Route::put('/update-city/{city_id}/parcel' , [Parcel::class , 'updateParcelCity']);

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

        //manage customer
        Route::get('/customers',[Customer::class , 'customerIndex']);
        Route::get('/customer/list', [Customer::class , 'customers'])->name('customers.list');
        Route::get('/customer/{customer_id}', [Customer::class , 'getCustomer']);

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


    });
});


//to manage the tenants

Route::prefix('e-ticket')->name('e-ticket.')->group(function(){

    Route::get('', [AuthLogin::class , 'eticketLogin'])->name('login-page');
//    Route::post('/user',[AuthLogin::class,'fetchUser'])->name('user');
    Route::post('/logout-tenant',[AuthLogin::class , 'logout'] )->name('logout');
    Route::post('/login-tenant' , [AuthLogin::class , 'loginTenant'])->name('login');

    Route::group(['middleware' => ['e-ticket','prevent-back-history']], function() {

        Route::get('/dashboard' , [AuthLogin::class , 'dashboard'])->name('dashboard');

        //manage bus
        Route::get('/buses' , [ManageBus::class , 'allBuses'])->name('fetch-buses');
        Route::get('fetch-tenant-buses',[ManageBus::class , 'fetchOBuses'])->name('fetch-tenant-buses');
        Route::get('view-tenant-bus/{bus_id}',[ManageBus::class , 'viewBus'])->name('view-tenant-bus');


        Route::get('edit-tenant-bus/{bus_id}',[ManageBus::class , 'editBus'])->name('edit-tenant-bus');
        Route::put('update-tenant-bus/{bus_id}', [ManageBus::class , 'updateBus']);
        Route::get('add-new-tenant-bus', [ManageBus::class , 'addNewBus']);
        Route::post('post-new-tenant-bus', [ManageBus::class , 'createTenantBus']);
        Route::get('assign-driver/{bus_id}',[ManageBus::class , 'assignDriver']);
        Route::put('assign-driver/{bus_id}',[ManageBus::class , 'assignDriverToBus']);
        Route::get('remove-driver-from-bus/{driver_id}/{bus_id}' ,[ManageBus::class , 'removeDriverFromBus']);

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

        //manage e-tickets locations
        Route::get('locations' , [EticketLocation::class , 'manageLocations']);
        Route::get('add-location', [EticketLocation::class , 'addLocation']);
        Route::post('store-location',[EticketLocation::class , 'storeLocation']);
        Route::get('fetch-tenant-locations', [EticketLocation::class ,'fetchLocation'])->name('fetch-tenant-locations');
        Route::get('view-tenant-location/{location_id}', [EticketLocation::class , 'viewLocation']);


        //schedule trip for buses
        Route::get('/schedule/{bus_id}',[ManageBus::class , 'scheduleTrip']);
        Route::post('add-eticket-schedule', [EticketSchedule::class , 'addEticketSchedule'])->name('add-eticket-schedule');
        Route::get('all-scheduled-trip',[EticketSchedule::class , 'allScheduledTrip']);
        Route::get('fetch-scheduled-trip', [EticketSchedule::class, 'fetchAllSchedules'])->name('fetch-scheduled-trip');
        Route::get('view-each-schedule/{schedule_id}' , [EticketSchedule::class , 'viewEachSchedule']);
        Route::get('view-bus-each-schedule/{bus_id}', [EticketSchedule::class , 'viewBusSchedule']);
        Route::get('view-bus-schedules/{bus_id}', [EticketSchedule::class , 'viewEachBusSchedule'])->name('view-bus-schedules');



        //check schedule manifest
        Route::get('schedule-manifest/{schedule_id}', [EticketManifest::class , 'manifest']);
        Route::get('fetch-bus-manifest/{schedule_id}', [EticketManifest::class ,'fetchBusManifest'])->name('fetch-bus-manifest');
        Route::get('fetch-passenger-details/{seat_tracker_id}', [EticketManifest::class , 'fetchPassengerDetails']);

        //manage staffs
        Route::get('staffs' , [StaffMgt::class , 'allStaff']);
        Route::get('fetch-tenant-staffs', [StaffMgt::class , 'fetchStaffs'])->name('fetch-tenant-staffs');
        Route::get('create-staff' , [StaffMgt::class , 'createStaff']);
        Route::post('store-staff' , [StaffMgt::class , 'storeStaff']);
        Route::get('store-edit/{staff_id}' , [StaffMgt::class , 'editStaff']);
        Route::put('store-update/{staff_id}', [StaffMgt::class , 'updateStaff']);
        Route::get('view-staff/{staff_id}', [StaffMgt::class , 'viewStaff']);
        Route::get('terminate/{staff_id}/appointment',[StaffMgt::class ,'terminateAppointment']);


    });


});
