<?php

use Illuminate\Support\Facades\Route;
use Modules\Faq\Http\Controllers\Admin\FaqController;
use Modules\Faq\Http\Controllers\Writer\FaqController as WriterFaqController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {
    Route::controller(FaqController::class)->as('faqs.')->prefix('faqs')->group(function () {
        Route::get('', 'index')->name('index');
        Route::delete('destroy/{faq}', 'destroy')->name('destroy');
    });
});

Route::group(['prefix' => 'writer', 'as' => 'writer.', 'middleware' => ['writer', 'auth']], function () {
    Route::resource('faqs', WriterFaqController::class)->except(['show', 'destroy']);
});