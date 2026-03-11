<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;

Route::get('/', [DoctorController::class,'index']);
Route::post('/register-doctor', [DoctorController::class,'store'])->name('doctor.store');
Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

Route::prefix('admin')->group(function(){

    Route::get('/login',[AdminController::class,'login'])->name('admin.login');
    Route::post('/login',[AdminController::class,'checkLogin'])->name('admin.check');

    Route::middleware('auth')->group(function(){

        Route::get('/dashboard',[AdminController::class,'index'])->name('admin.dashboard');

        Route::get('/doctors',[AdminController::class,'doctors'])->name('admin.doctors');

        Route::post('/logout',[AdminController::class,'logout'])->name('admin.logout');

    });

});
