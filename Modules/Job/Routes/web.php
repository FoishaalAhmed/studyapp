<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {
    Route::resource('job-categories', JobCategoryController::class)->except(['show', 'create', 'edit']);

    Route::controller(JobController::class)->as('jobs.')->prefix('jobs')->group(function () {
        Route::get('', 'index')->name('index');
        Route::delete('jobs/destroy/{job}', 'destroy')->name('destroy');
    });
    Route::controller(JobUserController::class)->as('jobs.users.')->prefix('job-users')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('show/{jobId}/{userId}', 'show')->name('show');
    });
});
