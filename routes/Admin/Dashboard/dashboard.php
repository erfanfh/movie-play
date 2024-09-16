<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\is_admin;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', is_admin::class], 'prefix' => 'admin'], function () {
    //Dashboard
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
