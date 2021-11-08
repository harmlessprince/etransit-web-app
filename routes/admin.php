<?php

    use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\Schedule;
use App\Http\Controllers\Terminal;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Vehicle;
use Illuminate\Support\Facades\Route;


    Route::get('/' , [AdminLogin::class , 'showLoginForm'])->name('admin.login');

    Route::post('/logout-admin',[AdminLogin::class , 'logout'] )->name('admin.logout');
    Route::post('/login-user' , [AdminLogin::class , 'loginAdmin']);

    Route::group(['middleware' => ['admin']], function() {
        Route::get('/dashboard', [Dashboard::class, 'dashboard'])->name('dashboard');

        //vehicle management
        Route::get('/manage/vehicle', [Vehicle::class, 'manage'])->name('manage.vehicle');
        Route::post('/add/vehicle', [Vehicle::class, 'addVehicle'])->name('add.vehicle');

        Route::get('import', [Vehicle::class, 'importExportView']);
        Route::get('export/vehicle', [Vehicle::class, 'exportVehicle'])->name('export.vehicle');
        Route::post('import/vehicle', [Vehicle::class, 'importVehicle'])->name('import.vehicle');

        //manage terminal
        Route::get('manage/terminals',[Terminal::class , 'Terminals']);
        Route::post('add/terminal',[Terminal::class , 'AddTerminal']);

        //schedule an event
        Route::get('/event/{terminal_id}/schedule' ,[Schedule::class , 'scheduleEvent']);
        Route::post('/schedule/event', [Schedule::class , 'addEvent']);

    });
