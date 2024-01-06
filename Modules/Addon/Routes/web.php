<?php

use Modules\Addon\Http\Controllers\AddonController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin', 'ip_middleware']], function() {
    Route::controller(AddonController::class)->as('addons.')->group(function () {
        Route::get('addons', 'index')->name('index');
        Route::get('addon/switch-status/{alias}', 'switchStatus')->name('switch-status');;
    });
});
