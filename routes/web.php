<?php

use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\Dashboard;
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
Route::get('/', function () {
    return view('welcome');
});
//Route::any('{slug}' , function(){
//    return view('welcome');
//});
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::domain('app.' . env('SITE_URL'))->middleware('web')->group(function() {
    Route::get('/admin-login' , [AdminLogin::class , 'showLoginForm']);
    Route::post('/login-user' , [AdminLogin::class , 'loginAdmin']);
    Route::get('/dashboard' , [Dashboard::class ,'dashboard'])->name('dashboard');
});

