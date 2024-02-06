<?php

use Illuminate\Support\Facades\Route;
use Modules\Forum\Http\Controllers\Api\{
    ForumController,
    ForumCommentController,
    ForumCommentReplyController
};

Route::group(['middleware' => 'auth:sanctum'], fn () => [
    Route::controller(ForumController::class)->prefix('forums')->group(fn () => [
        Route::get('', 'index'),
        Route::post('store', 'store'),
        Route::get('show/{id}', 'show')
    ]),

    Route::controller(ForumCommentController::class)->prefix('forum-comments')->group(fn () => [
        Route::post('vote', 'vote'),
        Route::post('store', 'store'),
        Route::post('correct-answer', 'correct'),

    ]),

    Route::post('forum-reply/store', [ForumCommentReplyController::class, 'store'])
]);
