<?php

//Profile
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/password/edit', [ProfileController::class, 'updatePassword'])->name('password.update');

    //User Profiles
    Route::get('/{username}', [ProfileController::class, 'userProfile'])->name('profile.user');
});
