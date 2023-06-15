<?php

use Modules\UserAccess\Http\Controllers\UserPermissionController;
use Modules\UserAccess\Http\Controllers\UserLogController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {
    Route::controller(UserLogController::class)->group(function () {
        Route::get('user-logs', 'create')->name('create');
        Route::post('writer-logs', 'store')->name('store');
        Route::post('writer-history', 'store')->name('store');
        Route::post('logs/destroy/{log}', 'store')->name('store');
    });

    Route::get('user-logs', [UserLogController::class, 'userLog'])->name('logs.user');
    Route::get('writer-logs', [UserLogController::class, 'writerLog'])->name('logs.writer');
    Route::get('writer-history', [UserLogController::class, 'writerDetail'])->name('writer.history');
    Route::delete('logs/destroy/{log}', [UserLogController::class, 'destroy'])->name('logs.destroy');

    Route::resource('accesses', UserPermissionController::class)->except(['show', 'edit', 'update']);
});
