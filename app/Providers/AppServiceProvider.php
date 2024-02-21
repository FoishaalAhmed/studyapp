<?php

namespace App\Providers;

use App\Enums\CategoryType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        \Illuminate\Pagination\Paginator::useBootstrap();
        $shareData = [
            'contact' => \App\Models\Contact::first(),

            'mcqSubCategories' => \Modules\Category\Entities\SubCategory::withCount('models')->whereIn('type', [CategoryType::ModelTest, CategoryType::CommonModelTest])->latest('models_count')->take(15)->get()->toArray(),

            'ebookSubCategories' => \Modules\Category\Entities\SubCategory::withCount('ebooks')->whereIn('type', [CategoryType::Ebook, CategoryType::CommonEbook])->latest('ebooks_count')->take(15)->get()->toArray(),

            'sheetSubCategories' => \Modules\Category\Entities\SubCategory::withCount('sheets')->whereIn('type', [CategoryType::LectureSheet, CategoryType::CommonLectureSheet])->latest('sheets_count')->take(15)->get()->toArray(),

            'examCategories' => \Modules\Category\Entities\Category::withCount('exams')->latest('exams_count')->take(15)->get()->toArray(),

            'jobCategories' => \Modules\Job\Entities\JobCategory::withCount('jobs')->latest('jobs_count')->take(15)->get()->toArray()
        ];
        if (isActive('Job')) {
            $shareData['jobCategories'] = \Modules\Job\Entities\JobCategory::withCount('jobs')->latest('jobs_count')->take(15)->get()->toArray();
        }

        view()->share($shareData);
    }
}
