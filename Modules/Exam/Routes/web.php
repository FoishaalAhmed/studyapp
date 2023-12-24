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
    
    Route::controller(ExamTypeController::class)->prefix('exam-types')->as('exam-types.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::put('update', 'update')->name('update');
        Route::delete('destroy/{examType}', 'destroy')->name('destroy');
    });

    Route::controller(ExamController::class)->prefix('exams')->as('exams.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('edit/{exam}', 'edit')->name('edit');
        Route::get('status/{exam}/{status}', 'status')->name('status');
        Route::put('update/{exam}', 'update')->name('update');
        Route::delete('destroy/{exam}', 'destroy')->name('destroy');
    });

    Route::controller(ExamQuestionController::class)->prefix('exam-questions')->as('exam-questions.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('edit/{question}', 'edit')->name('edit');
        Route::put('update/{question}', 'update')->name('update');
        Route::delete('destroy/{question}', 'destroy')->name('destroy');
    });
});

Route::group(['prefix' => 'writer', 'as' => 'writer.', 'middleware' => ['writer', 'auth']], function () {

    Route::resource('exams', WriterExamController::class)
        ->except(['destroy']);

    Route::resource('exam-questions', WriterExamQuestionController::class)
        ->except(['destroy']);
});
