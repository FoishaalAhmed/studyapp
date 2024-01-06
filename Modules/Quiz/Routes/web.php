<?php

use Illuminate\Support\Facades\Route;
use Modules\Quiz\Http\Controllers\Admin\{QuizController, QuizQuestionController};

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin','auth', 'ip_middleware']], function () {

    Route::resource('quizzes', QuizController::class);
    Route::get('quizzes/status/{quiz}/{status}', [QuizController::class, 'status'])->name('quizzes.status');

    Route::controller(QuizQuestionController::class)->prefix('quiz-questions')->as('quiz-questions.')
    ->group(function () {
        Route::get('', 'index')->name('index');
    });

});
