<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;

Route::controller(DashboardController::class)
->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
    Route::get('ranks', 'rank')->name('ranks');
    Route::get('resource-buys', 'buy')->name('resource-buys');
});


