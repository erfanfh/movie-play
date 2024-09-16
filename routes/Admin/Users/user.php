<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Middleware\is_admin;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', is_admin::class], 'prefix' => 'admin'], function () {
    //Users
    Route::get('users', [AdminUserController::class, 'users'])->name('dashboard.users');
    Route::put('users/{user}', [AdminUserController::class, 'userUpdate'])->name('dashboard.users.update');
    Route::put('users/password/{user}', [AdminUserController::class, 'userPasswordUpdate'])->name('dashboard.users.password.update');
    Route::delete('users/{user}', [AdminUserController::class, 'userDestroy'])->name('dashboard.users.destroy');
    Route::get('users/{user}', [AdminUserController::class, 'userShow'])->name('dashboard.users.show');
});
