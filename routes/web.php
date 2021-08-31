<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UserLoginController;
use App\Http\Controllers\Frontend\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Frontend'],function(){
    Route::any('/',[ApplicationController::class,'index'])->name('home');
    Route::any('/about',[ApplicationController::class,'about'])->name('about');
    Route::any('/contact',[ApplicationController::class,'contact'])->name('contact');
});

Route::group(['namespace'=>'Backend'],function(){
    Route::get('/login',[UserLoginController::class,'index'])->name('login');
    Route::post('/login',[UserLoginController::class,'login']);
});

Route::group(['namespace'=>'Backend','prefix'=>'backend','middleware'=>'auth'],function(){
    Route::any('/',[DashboardController::class,'index'])->name('dashboard');

    Route::group(['prefix'=>'users'],function(){
        Route::any('/',[UserController::class,'index'])->name('users');
        Route::any('/create-user',[UserController::class,'insert'])->name('user-create');

    });

    Route::any('/logout',[UserLoginController::class,'logout'])->name('logout');
});

