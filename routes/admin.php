<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    DashboardController,
    WriterController,
    AdminController,
    UserController,
};

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('users', UserController::class)->except(['show']);
Route::resource('admins', AdminController::class)->except(['show']);
Route::resource('writers', WriterController::class)->except(['show']);