<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('game', [GameController::class, 'index'])->name('game.index');
});
