<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin','auth', 'ip_middleware']], function () {
    Route::resource('subjects', SubjectController::class)->except(['show']);
});
