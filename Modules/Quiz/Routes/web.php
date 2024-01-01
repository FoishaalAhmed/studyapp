<?php

use Illuminate\Support\Facades\Route;
use Modules\Quiz\Http\Controllers\Admin\QuizController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {

    Route::resource('quizzes', QuizController::class);
    Route::get('quizzes/status/{quiz}/{status}', [QuizController::class, 'status'])->name('quizzes.status');
});
