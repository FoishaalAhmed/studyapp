<?php

use Modules\Category\Http\Controllers\CategoryTypeController;
use Modules\Category\Http\Controllers\SubCategoryController;
use Modules\Category\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {
    Route::resource('category-types', CategoryTypeController::class)->except(['show', 'create', 'edit']);
    Route::resource('categories', CategoryController::class)->except(['show', 'create', 'edit']);
    Route::resource('sub-categories', SubCategoryController::class)->except(['show']);
});
