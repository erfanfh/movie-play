<?php

use App\Http\Controllers\LeaderboardController;
use Illuminate\Support\Facades\Route;


//Leaderboard
Route::get('leaderboard', [LeaderboardController::class, 'list'])->name('leaderboard.list');
