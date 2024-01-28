<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    HelperController,
    ProfileController,
    DashboardController,
    Frontend\HomeController
};

Route::get('/', [HomeController::class, 'index']);

Route::middleware('auth')->group(function () {

    /** Helpers route start here **/
    Route::post('get-sub-categories', [HelperController::class, 'getSubCategories'])->name('get.sub-category');
    Route::post('get-category-subject', [HelperController::class, 'getCategorySubject'])->name('get.category-subject');
    Route::post('get-child-category-subject', [HelperController::class, 'getChildCategorySubject'])->name('get.child-category-subject');
    Route::post('get-child-category-by-type-and-subcategory', [HelperController::class, 'getChildCategoryByTypeAndSubCategory'])->name('get.child-category-by-type-and-subcategory');
    Route::post('get-sub-category-by-category', [HelperController::class, 'getSubCategoryByCategory'])->name('get.sub-category-by-category');

    /** Helpers route end here **/

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::view('profile', 'backend.profile')->name('profile');
    Route::get('user/profile', [ProfileController::class, 'userProfile'])->name('user.profile');
    Route::post('photo-update', [ProfileController::class, 'photo'])->name('profile.photo');
    Route::post('password-update', [ProfileController::class, 'password'])->name('profile.password');
    Route::post('info-update', [ProfileController::class, 'info'])->name('profile.info');
});

require __DIR__.'/auth.php';
