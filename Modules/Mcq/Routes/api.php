<?php

use Illuminate\Support\Facades\Route;
use Modules\Mcq\Http\Controllers\Api\{McqController, QuestionAnswerController};

Route::group(['middleware' => ['auth:sanctum']], fn () => [

    Route::controller(McqController::class)->group(fn () => [
        Route::get('category-subject-mcq/{category_id}/{subject_id}', 'categorySubjectModelTest'),
        Route::get('category-mcq/{category_id}', 'categoryModelTest'),
        Route::get('subject-mcq/{category_id}', 'subjectModelTest'),
        Route::get('mcq-category', 'category'),
        Route::get('mcq-sub-category/{category_id}', 'subCategory'),
        Route::get('questions/{mcq_id}', 'questions'),
        Route::get('model/search', 'search'),
        Route::get('mcq/result/{mcq}', 'result'),
        Route::get('premium-mcq-category/{category_id}', 'premiumSubCategory'),

    ]),

    Route::controller(QuestionAnswerController::class)->group(fn () => [
        Route::get('mcq-answers', 'index'),
        Route::get('mcq-answers/{mcq_id}', 'answers'),
        Route::post('mcq-answers/store', 'store'),
    ]),
]);