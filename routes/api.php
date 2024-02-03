<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    UserCategoryController
};

Route::controller(AuthController::class)->group(fn () => [
    Route::post('login', 'login'),
    Route::get('categories', 'category'),
    Route::post('social-login', 'socialLogin'),
    Route::post('registration', 'registration'),
    Route::post('social-registration', 'socialRegistration'),
    Route::post('store-user-categories', 'storeUserCategories'),
]);

Route::group(['middleware' => 'auth:sanctum'], fn () => [
    Route::post('logout', [AuthController::class, 'logout']),

    Route::controller(UserCategoryController::class)->group(fn () => [
        Route::get('app-home-page', 'index'),
        Route::post('update-user-categories', 'update'),
        Route::get('user-subcategories', 'subCategory'),
        Route::get('user-child-categories', 'childCategory'),
    ]),
]);
