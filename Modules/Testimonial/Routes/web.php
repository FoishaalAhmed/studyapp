<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin','auth', 'ip_middleware']], function () {
    
    Route::controller(TestimonialController::class)->as('testimonials.')->prefix('testimonials')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('status/{testimonial}/{status}', 'status')->name('status');
        Route::delete('destroy/{testimonial}', 'destroy')->name('destroy');
    });
});