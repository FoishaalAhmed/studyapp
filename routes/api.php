<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    HelperController,
    ProfileController,
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

    Route::controller(HelperController::class)->group(fn () => [
        Route::post('user-log', 'userLog'),
        Route::get('active-modules', 'activeModules'),
        Route::get('user-subject-category', 'userCategoryAndSubject'),
    ]),

    Route::controller(ProfileController::class)->group(fn () => [
        Route::get('profile', 'index'),
        Route::post('photo-update', 'photo'),
        Route::post('password-update', 'password'),
        Route::post('info-update', 'info'),
        Route::get('all-info', 'allInfo')
    ]),
]);
