<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\Admin\{
    CategoryController,
    SubCategoryController, 
    CategoryTypeController, 
    ChildCategoryController
};

use Modules\Category\Http\Controllers\Writer\{
    SubCategoryController as WriterSubCategoryController,
    ChildCategoryController as WriterChildCategoryController
};

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {
    Route::resource('category-types', CategoryTypeController::class)->except(['show', 'create', 'edit']);
    Route::resource('categories', CategoryController::class)->except(['show', 'create', 'edit']);
    Route::resource('sub-categories', SubCategoryController::class)->except(['show']);
    Route::resource('child-categories', ChildCategoryController::class)->except(['show']);
});

Route::group(['prefix' => 'writer', 'as' => 'writer.', 'middleware' => ['writer', 'auth']], function () {
    Route::resource('sub-categories', WriterSubCategoryController::class)->except(['show']);
    Route::resource('child-categories', WriterChildCategoryController::class)->except(['show']);
});
