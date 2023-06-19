<?php

use Modules\UserAccess\Http\Controllers\UserPermissionController;
use Modules\UserAccess\Http\Controllers\UserLogController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {
    
    Route::controller(UserLogController::class)->group(function () {
        Route::get('user-logs', 'userLog')->name('logs.user');
        Route::post('writer-logs', 'writerLog')->name('logs.writer');
        Route::post('writer-history', 'writerDetail')->name('writer.history');
        Route::post('logs/destroy/{log}', 'destroy')->name('logs.destroy');
    });

    Route::controller(QueryController::class)->as('queries.')->prefix('queries')->group(function () {
        Route::get('', 'index')->name('index');
        Route::delete('destroy/{query}', 'destroy')->name('destroy');
    });
    
    Route::resource('accesses', UserPermissionController::class)->except(['show', 'edit', 'update']);
});
