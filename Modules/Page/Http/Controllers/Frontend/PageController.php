<?php

namespace Modules\Page\Http\Controllers\Frontend;

use App\Models\User;
use App\Enums\Status;
use Modules\Exam\Entities\Exam;
use Modules\Page\Entities\Page;
use Modules\Ebook\Entities\Ebook;
use Modules\Mcq\Entities\ModelTest;
use App\Http\Controllers\Controller;
use Modules\Content\Entities\Content;
use Modules\Testimonial\Entities\Testimonial;
use Modules\LectureSheet\Entities\LectureSheet;

class PageController extends Controller
{
    public function about()
    {
        $data = [
            'exam' => Exam::count(),
            'mcq' => ModelTest::count(),
            'vision' => Page::where('slug', 'our-vision')->first(),
            'workshop' => Page::where('slug', 'workshop')->first(),
            'about' => Page::where('slug', 'about')->firstOrFail(),
            'mission' => Page::where('slug', 'our-mission')->first(),
            'access' => Page::where('slug', 'life-time-access')->first(),
            'expert' => Page::where('slug', 'expert-instructors')->first(),
            'course' => Page::where('slug', 'high-quality-courses')->first(),
            'learns'=> Content::where('category', 'about-learn-with-us')->get(),
            'skills' => Content::where('category', 'about-where-you-like')->get(),
            'ebook' => module('Ebook') && isActive('Ebook') ? Ebook::count() : 0,
            'student' => User::whereHas("roles", fn($query) => [$query->where("name", "User")])->count(),
            'sheet' => module('LectureSheet') && isActive('LectureSheet') ? LectureSheet::count() : 0,
            'testimonials' => Testimonial::where('status', Status::PUBLISHED)->latest()->take(3)->get(['name', 'position', 'message', 'star', 'photo']),
        ];

        return view('page::frontend.about', $data);
    }

    public function pages($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('page::frontend.page', compact('page'));
    }
}
