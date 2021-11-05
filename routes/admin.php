<?php

use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;


Route::get('/' , [AdminLogin::class , 'showLoginForm']);
Route::post('/login-user' , [AdminLogin::class , 'loginAdmin']);
Route::get('/dashboard' , [Dashboard::class ,'dashboard'])->name('dashboard');

