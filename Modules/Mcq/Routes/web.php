<?php

use Illuminate\Support\Facades\Route;
use Modules\Mcq\Http\Controllers\Admin\{
    QuestionController,
    ModelTestController
};
use Modules\Mcq\Http\Controllers\Writer\{
    QuestionController as WriterQuestionController,
    ModelTestController as WriterModelTestController
};

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin','auth', 'ip_middleware']], function () {
    Route::controller(ModelTestController::class)->prefix('mcqs')->as('mcqs.')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('edit/{model}', 'edit')->name('edit');
            Route::get('status/{model}/{status}', 'status')->name('status');
            Route::put('update/{model}', 'update')->name('update');
            Route::delete('destroy/{model}', 'destroy')->name('destroy');
    });

    Route::controller(QuestionController::class)->prefix('questions')->as('questions.')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('edit/{question}', 'edit')->name('edit');
            Route::put('update/{question}', 'update')->name('update');
            Route::delete('destroy/{question}', 'destroy')->name('destroy');
    });
});

Route::group(['prefix' => 'writer', 'as' => 'writer.', 'middleware' => ['writer', 'auth']], function () {

    Route::post('mcq-questions/ajax-save', [WriterQuestionController::class, 'ajaxSave'])
    ->name('mcq-questions.ajax.save');
    Route::post('mcq-questions/bulk-update', [WriterQuestionController::class, 'bulkUpdate'])
    ->name('mcq-questions.bulk.update');

    Route::resource('mcqs', WriterModelTestController::class)
        ->except(['destroy']);

    Route::resource('mcq-questions', WriterQuestionController::class)
        ->except(['destroy']);
});
