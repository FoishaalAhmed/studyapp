<?php

use Illuminate\Support\Facades\Route;
use Modules\LectureSheet\Http\Controllers\Admin\LectureSheetController;
use Modules\LectureSheet\Http\Controllers\Writer\LectureSheetController as WriterLectureSheetController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin','auth', 'ip_middleware']], function () {
    Route::controller(LectureSheetController::class)->prefix('lecture-sheets')->as('lecture_sheets.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('edit/{sheet}', 'edit')->name('edit');
        Route::get('status/{sheet}/{status}', 'status')->name('status');
        Route::put('update/{sheet}', 'update')->name('update');
        Route::delete('destroy/{sheet}', 'destroy')->name('destroy');
        Route::get('download/{sheet}', 'download')->name('download');
    });
});

Route::group(['prefix' => 'writer', 'as' => 'writer.', 'middleware' => ['writer', 'auth']], function () {
    Route::resource('lecture-sheets', WriterLectureSheetController::class)
        ->except(['destroy']);
});