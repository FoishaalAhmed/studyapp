<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    BuyController,
    UserController,
    AdminController,
    WriterController,
    ContactController,
    DbBackupController,
    DashboardController,
    AppHomePageController,
    AppUserCategoryController,
    AppHomePageCategoryController,
    AppUserChildCategoryController,
};

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

/** contact route **/
Route::controller(ContactController::class)->as('contacts.')->prefix('contacts')->group(function () {
    Route::get('', 'index')->name('index');
    Route::put('update/{contact}', 'update')->name('update');
});

/** resource buy route **/
Route::controller(BuyController::class)->as('buys.')->prefix('resource-buys')->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('/{buy}/{status}', 'status')->name('status');
});

/** db backup route **/
Route::controller(DbBackupController::class)->as('backups.')->prefix('db-backups')->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('/store', 'store')->name('store');
    Route::get('/{backup}', 'download')->name('download');
});

Route::resource('users', UserController::class)->except(['show']);
Route::resource('admins', AdminController::class)->except(['show']);
Route::resource('writers', WriterController::class)->except(['show']);
Route::resource('app-home', AppHomePageController::class)->except(['show', 'destroy']);
Route::resource('app-home-category', AppHomePageCategoryController::class)->except(['show', 'destroy']);
Route::resource('app-user-categories', AppUserCategoryController::class)->except(['show', 'destroy']);
Route::resource('app-user-child-categories', AppUserChildCategoryController::class)->except(['show', 'destroy']);