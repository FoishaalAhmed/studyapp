<?php

use Illuminate\Support\Facades\Route;
use Modules\LectureSheet\Http\Controllers\Api\SheetController;

Route::group(['middleware' => 'auth:sanctum'], fn () => [
    Route::controller(SheetController::class)->group(fn () => [
        Route::get('category-subject-sheets/{category_id}/{subject_id}', 'categorySubjectSheet'),
        Route::get('category-sheets/{category_id}', 'categorySheet'),
        Route::get('subject-sheets/{subject_id}', 'subjectSheet'),
        Route::get('sheets', 'index'),
        Route::get('sheet-categories', 'category'),
        Route::get('sheet-sub-categories/{category_id}', 'subCategory'),
        Route::get('sheet-detail', 'detail'),
        Route::get('premium-sheet-categories/{category_id}', 'premiumSubCategory'),
    ]),
]);