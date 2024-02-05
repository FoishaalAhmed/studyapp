<?php

use Illuminate\Support\Facades\Route;
use Modules\Page\Http\Controllers\Api\PageController;

Route::group(['middleware' => 'auth:sanctum'], fn () => [
    Route::controller(PageController::class)->group(fn () => [
        Route::get('contact', 'contact'),
        Route::get('privacy-policy', 'privacy'),
        Route::get('term-and-conditions', 'terms'),
    ]),
]);
