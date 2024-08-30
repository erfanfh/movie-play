<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

//Auth
Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('loginPost', [AuthController::class, 'loginPost'])->name('login.post');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('registerPost', [AuthController::class, 'registerPost'])->name('register.post');
});

Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
