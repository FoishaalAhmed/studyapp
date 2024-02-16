<?php

use Illuminate\Support\Facades\Route;
use Modules\Mcq\Http\Controllers\Api\{McqController, QuestionAnswerController};

Route::group(['middleware' => ['auth:sanctum']], fn () => [

    Route::controller(McqController::class)->group(fn () => [
        Route::get('category-subject-mcq/{category_id}/{subject_id}', 'categorySubjectMcq'),
        Route::get('category-mcq/{category_id}', 'categoryMcq'),
        Route::get('subject-mcq/{category_id}', 'subjectMcq'),
        Route::get('mcq-category', 'category'),
        Route::get('mcq-sub-category/{category_id}', 'subCategory'),
        Route::get('mcq-questions/{mcq_id}', 'questions'),
        Route::get('mcq/search', 'search'),
        Route::get('mcq/result/{mcq}', 'result'),
        Route::get('mcq-premium-category/{category_id}', 'premiumSubCategory'),

    ]),

    Route::controller(QuestionAnswerController::class)->group(fn () => [
        Route::get('given-mcq', 'index'),
        Route::get('mcq-answers/{mcq_id}', 'answers'),
        Route::post('mcq-answers/store', 'store'),
    ]),
]);