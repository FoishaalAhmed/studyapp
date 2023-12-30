<?php

use Illuminate\Support\Facades\Route;
use Modules\Quiz\Http\Controllers\Admin\QuizController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {
    Route::controller(QuizController::class)->prefix('quizzes')->as('quizzes.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/change-status/{status}/{quiz}', 'changeStatus')->name('status');
    });
});
