<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {
    Route::controller(FaqController::class)->as('faqs.')->prefix('faqs')->group(function () {
        Route::get('', 'index')->name('index');
        Route::delete('destroy/{faq}', 'destroy')->name('destroy');
    });
});
