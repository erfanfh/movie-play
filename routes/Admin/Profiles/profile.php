<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\is_admin;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', is_admin::class], 'prefix' => 'admin'], function () {
    //Profiles
    Route::get('profile', [AdminController::class, 'profile'])->name('dashboard.profile');
});
