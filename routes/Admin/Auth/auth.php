<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    //Auth
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', [AdminController::class, 'adminLogin'])->name('admin.login');
        Route::get('register', [AdminController::class, 'adminRegister'])->name('admin.register');
        Route::post('registerPost', [AdminController::class, 'adminRegisterPost'])->name('admin.register.post');
    });
});
