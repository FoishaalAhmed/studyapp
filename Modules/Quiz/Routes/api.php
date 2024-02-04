<?php

use Illuminate\Support\Facades\Route;
use Modules\Quiz\Http\Controllers\Api\QuizController;

Route::group(['middleware' => 'auth:sanctum'], fn () => [
    Route::controller(QuizController::class)->prefix('quizzes')->group(fn () => [
        Route::get('', 'index'),
        Route::get('levels', 'levels'),
        Route::get('questions', 'question'),
        Route::post('level-complete', 'levelComplete'),
    ])
]);