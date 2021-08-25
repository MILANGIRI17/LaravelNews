<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Frontend'],function(){
    Route::any('/',[ApplicationController::class,'index'])->name('home');
    Route::any('/about',[ApplicationController::class,'about'])->name('about');
    Route::any('/contact',[ApplicationController::class,'contact'])->name('contact');
});

Route::group(['namespace'=>'Backend','prefix'=>'company-backend'],function(){
    Route::any('/',[DashboardController::class,'index'])->name('dashboard');
});

