<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    DashboardController,
    ProfileController,
    HelperController
};

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    /** Helpers route start here **/
    Route::post('get-sub-categories', [HelperController::class, 'getSubCategories'])->name('get.sub-category');
    Route::post('get-category-subject', [HelperController::class, 'getCategorySubject'])->name('get.category-subject');
    Route::post('get-child-category-subject', [HelperController::class, 'getChildCategorySubject'])->name('get.child-category-subject');
    Route::post('get-child-category-by-type-and-subcategory', [HelperController::class, 'getChildCategoryByTypeAndSubCategory'])->name('get.child-category-by-type-and-subcategory');

    /** Helpers route end here **/


    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::view('profile', 'backend.profile')->name('profile');
    Route::post('photo-update', [ProfileController::class, 'photo'])->name('profile.photo');
    Route::post('password-update', [ProfileController::class, 'password'])->name('profile.password');
    Route::post('info-update', [ProfileController::class, 'info'])->name('profile.info');
});

require __DIR__.'/auth.php';
