<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

require __DIR__ . '/Auth/auth.php';

require __DIR__ . '/Games/game.php';

require __DIR__ . '/Questions/question.php';

require __DIR__ . '/Admin/Auth/auth.php';

require __DIR__ . '/Admin/Dashboard/dashboard.php';

require __DIR__ . '/Admin/Profiles/profile.php';

require __DIR__ . '/Admin/Questions/question.php';

require __DIR__ . '/Admin/Users/user.php';

require __DIR__ . '/Profiles/profile.php';
