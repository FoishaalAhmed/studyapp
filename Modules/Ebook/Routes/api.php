<?php

use Illuminate\Support\Facades\Route;
use Modules\Ebook\Http\Controllers\Api\EbookController;

Route::group(['middleware' => 'auth:sanctum'], fn () => [
    Route::controller(EbookController::class)->group(fn () => [
        Route::get('ebooks', 'index'),
        Route::get('ebooks/{id}', 'ebook'),
        Route::get('ebook-categories', 'category'),
        Route::get('subject-ebooks/{subject_id}', 'subjectEbook'),
        Route::get('category-ebooks/{category_id}', 'categoryEbook'),
        Route::get('ebook-sub-categories/{category_id}', 'commonChildCategory'),
        Route::get('premium-ebook-categories/{category_id}', 'premiumChildCategory'),
        Route::get('category-subject-ebooks/{category_id}/{subject_id}', 'categorySubjectEbook'),
    ])
]);