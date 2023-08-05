<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {
    Route::controller(ExamTypeController::class)->prefix('exam-types')->as('exam-types.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::put('update', 'update')->name('update');
        Route::delete('destroy/{examType}', 'destroy')->name('destroy');
    });
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {
    Route::controller(ExamController::class)->prefix('exams')->as('exams.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::put('update', 'update')->name('update');
        Route::delete('destroy/{examType}', 'destroy')->name('destroy');
    });
});
