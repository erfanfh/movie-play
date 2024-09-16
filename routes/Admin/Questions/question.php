<?php

use App\Http\Controllers\AdminQuestionController;
use App\Http\Middleware\is_admin;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', is_admin::class], 'prefix' => 'admin'], function () {
    //Questions
    Route::get('questions', [AdminQuestionController::class, 'questions'])->name('dashboard.questions');
    Route::post('questions', [AdminQuestionController::class, 'questionsPost'])->name('dashboard.questions.post');
    Route::put('questions/{question}', [AdminQuestionController::class, 'questionsUpdate'])->name('dashboard.questions.update');
    Route::delete('questions/{question}', [AdminQuestionController::class, 'questionsDestroy'])->name('dashboard.questions.destroy');
    Route::get('questions/{question}', [AdminQuestionController::class, 'questionShow'])->name('dashboard.questions.show');
});
