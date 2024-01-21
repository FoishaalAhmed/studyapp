<?php

use Illuminate\Support\Facades\Route;
use Modules\Forum\Http\Controllers\{
    Admin\ForumController,
    User\ForumController as UserForumController
};

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

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['user', 'auth']], function () {
    Route::controller(UserForumController::class)->as('forums.')->prefix('forums')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('detail/{forum}/{title}', 'detail')->name('detail');
        Route::get('load-more-forum-post', 'loadMore')->name('load.post');
    });
});