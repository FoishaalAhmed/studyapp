<?php

use Modules\UserAccess\Http\Controllers\UserPermissionController;
use Modules\UserAccess\Http\Controllers\UserLogController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin','auth', 'ip_middleware']], function () {
    
    Route::controller(UserLogController::class)->group(function () {
        Route::get('user-logs', 'userLog')->name('logs.user');
        Route::get('writer-logs', 'writerLog')->name('logs.writer');
        Route::get('writer-history', 'writerDetail')->name('writer.history');
        Route::delete('logs/destroy/{log}', 'destroy')->name('logs.destroy');
    });

    Route::controller(QueryController::class)->as('queries.')->prefix('queries')->group(function () {
        Route::get('', 'index')->name('index');
        Route::delete('destroy/{query}', 'destroy')->name('destroy');
    });
    
    Route::resource('accesses', UserPermissionController::class)->except(['show', 'edit', 'update']);
});
