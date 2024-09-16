<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('game/questions', [QuestionController::class, 'show'])->name('question.show');
    Route::get('game/playover', [QuestionController::class, 'playover'])->name('question.playover');
    Route::post('game/checkAnswer/{question}', [QuestionController::class, 'checkAnswer'])->name('question.checkAnswer');
});
