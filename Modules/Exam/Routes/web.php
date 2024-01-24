<?php

use Illuminate\Support\Facades\Route;
use Modules\Exam\Http\Controllers\{
    Admin\ExamController, 
    Admin\ExamTypeController, 
    Admin\ExamQuestionController,
    User\ExamController as UserExamController,
    Writer\ExamController as WriterExamController,
    Writer\ExamQuestionController as WriterExamQuestionController
};

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin','auth', 'ip_middleware']], function () {

    Route::get('exams/status/{exam}/{status}', [ExamController::class, 'status'])
    ->name('exams.status');

    Route::controller(ExamTypeController::class)->prefix('exam-types')->as('exam-types.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::put('update', 'update')->name('update');
        Route::delete('destroy/{examType}', 'destroy')->name('destroy');
    });

    Route::resource('exams', ExamController::class)
        ->except(['show']);

    Route::controller(ExamQuestionController::class)->prefix('exam-questions')->as('exam-questions.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('edit/{question}', 'edit')->name('edit');
        Route::put('update/{question}', 'update')->name('update');
        Route::delete('destroy/{question}', 'destroy')->name('destroy');
    });
});

Route::group(['prefix' => 'writer', 'as' => 'writer.', 'middleware' => ['writer', 'auth']], function () {

    Route::post('exam-questions/ajax-save', [WriterExamQuestionController::class, 'ajaxSave'])
    ->name('exam-questions.ajax.save');
    Route::post('exam-questions/bulk-update', [WriterExamQuestionController::class, 'bulkUpdate'])
    ->name('exam-questions.bulk.update');

    Route::resource('exams', WriterExamController::class)
        ->except(['destroy']);

    Route::resource('exam-questions', WriterExamQuestionController::class)
        ->except(['destroy']);
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['user', 'auth']], function () {

    Route::controller(UserExamController::class)->prefix('exams')->as('exams.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('all-live-exams', 'live')->name('live');
        Route::get('all-subject-exams', 'subject')->name('subject');
        Route::get('all-chapter-exams', 'chapter')->name('chapter');
        Route::get('exams/detail/{exam}/{title}', 'detail')->name('detail');
        Route::get('exams/enroll/{exam}', 'enroll')->name('enroll');
        Route::get('exams/{exam}/{title}', 'exam')->name('exam');
        Route::get('exams/result/{exam}/{title}', 'result')->name('result');
        Route::post('exams/{exam}', 'store')->name('store');
    });
});
