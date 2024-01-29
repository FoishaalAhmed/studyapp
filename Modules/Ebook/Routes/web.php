<?php

use Illuminate\Support\Facades\Route;
use Modules\Ebook\Http\Controllers\{
    Admin\EbookController,
    User\EbookController as UserEbookController,
    Writer\EbookController as WriterEbookController,
    Frontend\EbookController as FrontendEbookController
};

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin','auth', 'ip_middleware']], function () {
    Route::controller(EbookController::class)->prefix('ebooks')->as('ebooks.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('edit/{ebook}', 'edit')->name('edit');
        Route::get('status/{ebook}/{status}', 'status')->name('status');
        Route::put('update/{ebook}', 'update')->name('update');
        Route::delete('destroy/{ebook}', 'destroy')->name('destroy');
        Route::get('download/{ebook}', 'download')->name('download');
    });
});

Route::group(['prefix' => 'writer', 'as' => 'writer.', 'middleware' => ['writer', 'auth']], function () {
    Route::resource('ebooks', WriterEbookController::class)
        ->except(['destroy']);
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['user', 'auth']], function () {
    Route::controller(UserEbookController::class)->prefix('ebooks')->as('ebooks.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('all-categories', 'allCategory')->name('all.categories');
        Route::get('ebook-categories/{category}/{title}', 'category')->name('categories');
        Route::get('download/{ebook}', 'download')->name('download');
        Route::get('read/{ebook}/{chapter}', 'read')->name('read');
    });
});

Route::controller(FrontendEbookController::class)->prefix('ebooks')->as('ebooks.')->group(function () {
    Route::get('', 'index')->name('grid');
    Route::get('list', 'list')->name('list');
    Route::get('search', 'search')->name('search');
    Route::get('detail', 'detail')->name('detail');
    Route::get('categories', 'categoryEbook')->name('category');
    Route::get('subject', 'subjectEbook')->name('subject');
});
