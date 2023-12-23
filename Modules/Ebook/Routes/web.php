<?php

use Illuminate\Support\Facades\Route;
use Modules\Ebook\Http\Controllers\Admin\EbookController;
use Modules\Ebook\Http\Controllers\Writer\EbookController as WriterEbookController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {
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
