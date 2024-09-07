<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
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

//Game
Route::get('game', [GameController::class, 'index'])->name('game.index')->middleware('auth');

//Question
Route::get('game/questions', [QuestionController::class, 'show'])->name('question.show')->middleware('auth');
Route::get('game/playover', [QuestionController::class, 'playover'])->name('question.playover')->middleware('auth');
Route::post('game/checkAnswer/{question}', [QuestionController::class, 'checkAnswer'])->name('question.checkAnswer')->middleware('auth');

//Profile
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile')->middleware('auth');
Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit')->middleware('auth');
Route::post('/profile/edit', [ProfileController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
Route::post('/password/edit', [ProfileController::class, 'updatePassword'])->name('password.update')->middleware('auth');

//User Profile
Route::get('/{username}', [ProfileController::class, 'userProfile'])->name('profile.user')->middleware('auth');
