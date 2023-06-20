<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    DashboardController,
    ContactController,
    WriterController,
    AdminController,
    UserController,
};

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

/** contact route **/
Route::controller(ContactController::class)->as('contacts.')->prefix('contacts')->group(function () {
    Route::get('', 'index')->name('index');
    Route::put('update/{contact}', 'update')->name('update');
});


Route::resource('users', UserController::class)->except(['show']);
Route::resource('admins', AdminController::class)->except(['show']);
Route::resource('writers', WriterController::class)->except(['show']);