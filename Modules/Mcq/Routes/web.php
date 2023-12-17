<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {
    Route::controller(ModelTestController::class)->prefix('mcqs')->as('mcqs.')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('edit/{model}', 'edit')->name('edit');
            Route::get('status/{model}/{status}', 'status')->name('status');
            Route::put('update/{model}', 'update')->name('update');
            Route::delete('destroy/{model}', 'destroy')->name('destroy');
            Route::get('download/{model}', 'download')->name('download');
        });
});
