<?php

use Illuminate\Support\Facades\Route;
use Modules\LectureSheet\Http\Controllers\{
    Admin\LectureSheetController,
    User\LectureSheetController as UserLectureSheetController,
    Writer\LectureSheetController as WriterLectureSheetController,
    Frontend\LectureSheetController as FrontendLectureSheetController
};

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

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['user', 'auth']], function () {
    Route::controller(UserLectureSheetController::class)->prefix('sheets')->as('sheets.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('all-categories', 'allCategory')->name('all.categories');
        Route::get('sheet-categories/{category}/{title}', 'category')->name('categories');
        Route::get('download/{sheet}', 'download')->name('download');
        Route::get('read/{sheet}/{chapter}', 'read')->name('read');
    });
});
Route::controller(FrontendLectureSheetController::class)->prefix('sheets')->as('sheets.')->group(function () {

    Route::get('', 'index')->name('grid');
    Route::get('list', 'list')->name('list');
    Route::get('search', 'search')->name('search');
    Route::get('detail', 'detail')->name('detail');
    Route::get('categories', 'categorySheet')->name('category');
    Route::get('subject', 'subjectSheet')->name('subject');

});