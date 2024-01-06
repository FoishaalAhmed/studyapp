<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin','auth', 'ip_middleware']], function () {
    Route::controller(ForumController::class)->prefix('forums')->as('forums.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('forums/status-change/{forum}/{status}', 'forumStatus')->name('status');
        Route::get('/details/{forum}', 'details')->name('details');
        Route::get('/comment/status-change/{comment}/{status}', 'commentStatus')->name('comment.status');
        Route::get('/comment/details/{comment}', 'commentDetail')->name('comment.details');
        Route::get('/reply/status-change/{reply}/{status}', 'replyStatus')->name('reply.status');
    });
});

