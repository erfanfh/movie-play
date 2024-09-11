<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminQuestionController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Middleware\is_admin;
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


//------------Admin---------------//
Route::group(['prefix' => 'admin'], function () {
    //Auth
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', [AdminController::class, 'adminLogin'])->name('admin.login');
        Route::get('register', [AdminController::class, 'adminRegister'])->name('admin.register');
        Route::post('registerPost', [AdminController::class, 'adminRegisterPost'])->name('admin.register.post');
    });

    //Dashboard
    Route::group(['middleware' => 'auth'], function () {
        Route::group(['middleware' => is_admin::class], function () {
            //Dashboard
            Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

            //Profile
            Route::get('profile', [AdminController::class, 'profile'])->name('dashboard.profile');

            //Questions
            Route::get('questions', [AdminQuestionController::class, 'questions'])->name('dashboard.questions');
            Route::post('questions', [AdminQuestionController::class, 'questionsPost'])->name('dashboard.questions.post');
            Route::put('questions/{question}', [AdminQuestionController::class, 'questionsUpdate'])->name('dashboard.questions.update');
            Route::delete('questions/{question}', [AdminQuestionController::class, 'questionsDestroy'])->name('dashboard.questions.destroy');
            Route::get('questions/{question}', [AdminQuestionController::class, 'questionShow'])->name('dashboard.questions.show');

            //Users
            Route::get('users', [AdminUserController::class, 'users'])->name('dashboard.users');
            Route::put('users/{user}', [AdminUserController::class, 'userUpdate'])->name('dashboard.users.update');
            Route::put('users/password/{user}', [AdminUserController::class, 'userPasswordUpdate'])->name('dashboard.users.password.update');
            Route::delete('users/{user}', [AdminUserController::class, 'userDestroy'])->name('dashboard.users.destroy');
            Route::get('users/{user}', [AdminUserController::class, 'userShow'])->name('dashboard.users.show');
        });
    });
});
