<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\{
    Admin\BlogController,
    Writer\BlogController as WriterBlogController,
    Frontend\BlogController as FrontendBlogController
};

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

Route::controller(FrontendBlogController::class)->as('blogs.')->prefix('blogs')->group(fn() => [
    Route::get('', 'index')->name('index'),
    Route::get('blog-detail', 'detail')->name('detail'),
    Route::get('blog-search', 'search')->name('search'),
    Route::get('tag-blogs', 'tag')->name('tag')
]);
