<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::controller(AuthController::class)->group(fn () => [
    Route::post('login', 'login'),
    Route::get('categories', 'category'),
    Route::post('social-login', 'socialLogin'),
    Route::post('registration', 'registration'),
    Route::post('social-registration', 'socialRegistration'),
    Route::post('store-user-categories', 'storeUserCategories'),
]);

Route::group(['middleware' => 'auth:sanctum'], fn () => [
    Route::post('logout', [AuthController::class, 'logout'])
]);
