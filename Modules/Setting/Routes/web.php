<?php

use Modules\Setting\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {
    // Route::resource('accesses', UserPermissionController::class)->except(['show']);
    Route::controller(SettingController::class)->as('settings.')->group(function () {
        Route::get('settings', 'create')->name('create');
        Route::post('settings/store', 'store')->name('store');;
    });
});
