<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\Admin\BlogController;
use Modules\Blog\Http\Controllers\Writer\BlogController as WriterBlogController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin', 'ip_middleware']], function () {

    Route::controller(BlogController::class)->as('blogs.')->prefix('blogs')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('status/{blog}/{status}', 'status')->name('status');
        Route::delete('destroy/{blog}', 'destroy')->name('destroy');
    });
});

Route::group(['prefix' => 'writer', 'as' => 'writer.', 'middleware' => ['auth', 'writer']], function () {
    Route::resource('blogs', WriterBlogController::class)->except(['show','destroy']);
});
