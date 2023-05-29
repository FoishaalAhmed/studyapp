<?php

use Modules\Category\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {
    Route::resource('categories', CategoryController::class)->except(['show', 'create', 'edit']);
});
