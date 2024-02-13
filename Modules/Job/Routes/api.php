<?php

use Illuminate\Support\Facades\Route;
use Modules\Job\Http\Controllers\Api\JobController;

Route::group(['middleware' => 'auth:sanctum'], fn () => [
    Route::controller(JobController::class)->group(fn () => [
        Route::get('jobs', 'index'),
        Route::get('job-categories', 'categories'),
        Route::get('category-jobs/{id}', 'categoryJobs'),
        Route::get('job-detail/{id}', 'detail'),
        Route::post('apply-for-job', 'jobApply')
    ]),
]);