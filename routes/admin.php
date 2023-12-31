<?php

use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\Car;
use App\Http\Controllers\Schedule;
use App\Http\Controllers\Terminal;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Transaction;
use App\Http\Controllers\Vehicle;
use Illuminate\Support\Facades\Route;


//
//    Route::get('/' , [AdminLogin::class , 'showLoginForm'])->name('admin.login.page');
//
//    Route::post('/logout-admin',[AdminLogin::class , 'logout'] )->name('admin.logout');
//    Route::post('/login-user' , [AdminLogin::class , 'loginAdmin'])->name('admin.login');
//
//
//    Route::group(['middleware' => ['prevent-back-history']], function() {
//
//        Route::get('/dashboard', [Dashboard::class, 'dashboard'])->name('admin.dashboard');
//
//        //vehicle management
//        Route::get('/manage/vehicle', [Vehicle::class, 'manage'])->name('manage.vehicle');
//        Route::post('/add/vehicle', [Vehicle::class, 'addVehicle'])->name('add.vehicle');
//
//        //bulk import buses
//        Route::get('import', [Vehicle::class, 'importExportView']);
//        Route::get('export/vehicle', [Vehicle::class, 'exportVehicle'])->name('export.vehicle');
//        Route::post('import/vehicle', [Vehicle::class, 'importVehicle'])->name('import.vehicle');
//
//        //manage terminal
//        Route::get('manage/terminals',[Terminal::class , 'Terminals']);
//        Route::post('add/terminal',[Terminal::class , 'AddTerminal']);
//
//        //bulk import terminals
//        Route::get('import-terminal', [Terminal::class, 'importExportViewTerminal']);
//        Route::get('export/terminal', [Terminal::class, 'exportTerminal'])->name('export.terminal');
//        Route::post('import/terminal', [Terminal::class, 'importTerminal'])->name('import.terminal');
//
//        //schedule an event
//        Route::get('/event/{bus_id}/schedule' ,[Schedule::class , 'scheduleEvent']);
//        Route::post('/schedule/event', [Schedule::class , 'addEvent']);
//
//        //manage transactions
//        Route::get('/transactions' , [Transaction::class , 'allTransactions']);
//
//        //manage car hiring module route
//        Route::get('/manage/cars' , [Car::class ,'allCars']);
//        Route::post('add/cars', [Car::class, 'addCars']);
//
//
//    });
