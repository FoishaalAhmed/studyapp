<?php

use Modules\Page\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin','auth', 'ip_middleware']], function() {
    Route::resource('pages', PageController::class)->except(['show']);
});
