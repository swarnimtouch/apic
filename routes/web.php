<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',[DoctorController::class,'index']);
Route::post('/register-doctor', [DoctorController::class,'store'])->name('doctor.store');

Route::prefix('admin')->group(function(){
    Route::get('/login',[AdminController::class,'login']);
    Route::post('/login',[AdminController::class,'checkLogin']);
    Route::get('/logout',[AdminController::class,'logout']);
    Route::get('/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/doctors',[AdminController::class,'doctors']);
});
