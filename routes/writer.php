<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Writer\DashboardController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
