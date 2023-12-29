<?php

use Illuminate\Support\Facades\Route;
use Modules\Exam\Http\Controllers\Admin\{
    ExamController, 
    ExamTypeController, 
    ExamQuestionController
};
use Modules\Exam\Http\Controllers\Writer\{
    ExamController as WriterExamController,
    ExamQuestionController as WriterExamQuestionController
};

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {

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
