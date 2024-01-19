<?php

use Illuminate\Support\Facades\Route;
use Modules\Job\Http\Controllers\{
    Admin\JobController,
    Admin\JobUserController,
    Admin\JobCategoryController,
    User\JobController as UserJobController,
    Writer\JobController as WriterJobController,
    Writer\JobCategoryController as WriterJobCategoryController,
    Writer\JobUserController as WriterJobUserController,
};

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin','auth', 'ip_middleware']], function () {
    Route::resource('job-categories', JobCategoryController::class)->except(['show', 'create', 'edit']);

    Route::controller(JobController::class)->as('jobs.')->prefix('jobs')->group(function () {
        Route::get('', 'index')->name('index');
        Route::delete('jobs/destroy/{job}', 'destroy')->name('destroy');
    });
    
    Route::controller(JobUserController::class)->as('jobs.users.')->prefix('job-users')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('show', 'show')->name('show');
    });
});

Route::group(['prefix' => 'writer', 'as' => 'writer.', 'middleware' => ['writer', 'auth']], function () {
    
    Route::resource('job-categories', WriterJobCategoryController::class)
        ->except(['show', 'create', 'edit', 'destroy']);
    
    Route::resource('jobs', WriterJobController::class)
        ->except(['show', 'destroy']);
    
    Route::controller(WriterJobUserController::class)->as('jobs.users.')->prefix('job-users')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('show', 'show')->name('show');
    });
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['user', 'auth']], function () {
    Route::controller(UserJobController::class)->as('jobs.')->prefix('jobs')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('detail/{job}/{title}', 'detail')->name('detail');
    });
});
