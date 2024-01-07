<?php

use Illuminate\Support\Facades\Route;
use Modules\Testimonial\Http\Controllers\Admin\TestimonialController;
use Modules\Testimonial\Http\Controllers\Writer\TestimonialController as WriterTestimonialController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth', 'ip_middleware']], function () {
    
    Route::controller(TestimonialController::class)->as('testimonials.')->prefix('testimonials')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('status/{testimonial}/{status}', 'status')->name('status');
        Route::delete('destroy/{testimonial}', 'destroy')->name('destroy');
    });
});

Route::group(['prefix' => 'writer', 'as' => 'writer.', 'middleware' => ['writer', 'auth']], function () {
    
    Route::resource('testimonials', WriterTestimonialController::class)->except(['show', 'destroy']);
});