<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {

    Route::controller(BlogController::class)->as('blogs.')->prefix('blogs')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('status/{blog}/{status}', 'status')->name('status');
        Route::delete('destroy/{blog}', 'destroy')->name('destroy');
    });
});
