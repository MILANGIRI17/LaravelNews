<?php

use App\Http\Controllers\Frontend\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Frontend'],function(){
    Route::any('/',[ApplicationController::class,'index'])->name('home');
});

// Route::group(['namespace'=>'Backend','prefix'='admin-section'],function(){

// });

