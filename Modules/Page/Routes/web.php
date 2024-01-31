<?php

use Illuminate\Support\Facades\Route;
use Modules\Page\Http\Controllers\{
    PageController,
    Frontend\PageController as FrontendPageController
};

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin','auth', 'ip_middleware']], function() {
    Route::resource('pages', PageController::class)->except(['show']);
});

Route::get('about-us', [FrontendPageController::class, 'about'])->name('about');
Route::get('pages/{slug}', [FrontendPageController::class, 'pages'])->name('pages');
