<?php

use Illuminate\Support\Facades\Route;
use Modules\Exam\Http\Controllers\Api\{ExamController, ExamQuestionAnswerController, ExamUserController};

Route::group(['middleware' => 'auth:sanctum'], fn () => [
    Route::controller(ExamController::class)->group(fn () => [
        Route::get('live-exam', 'live'),
        Route::get('exam-subjects', 'subjects'),
        Route::get('exam-result/{exam_id}', 'result'),
        Route::get('exam-question/{exam_id}', 'question'),
        Route::get('exam-detail/{id}', 'liveExamDetail'),
        Route::get('subject-based-exam/{subject_id}', 'subjectExam'),
        Route::get('chapter-based-exam/{subject_id}', 'subjectChapter'),
    ]),

    Route::controller(ExamQuestionAnswerController::class)->group(fn () => [
        Route::get('attend-exams', 'index'),
        Route::post('exam-answers/store', 'store'),
        Route::get('exam-answers/{exam_id}', 'answers'),
    ]),

    Route::post('exam-enroll', [ExamUserController::class, 'store'])
]);
