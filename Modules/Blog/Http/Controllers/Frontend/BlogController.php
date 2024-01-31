<?php

namespace Modules\Blog\Http\Controllers\Frontend;

use App\Enums\Status;
use Modules\Blog\Entities\Blog;
use Modules\Exam\Entities\Exam;
use Modules\Ebook\Entities\Ebook;
use Illuminate\Routing\Controller;
use Modules\Mcq\Entities\ModelTest;

class BlogController extends Controller
{
    public function index()
    {
        $data = [
            'tags'   => Blog::where('status', Status::PUBLISHED)->distinct('tag')->take(20)->get(['tag']),
            'exams'  => Exam::where('status', Status::PUBLISHED)->latest()->take(3)->get(['id', 'title', 'photo']),
            'blogs'  => Blog::where('status', Status::PUBLISHED)->latest('date')->paginate(20),
            'mcq'    => ModelTest::where('status', Status::PUBLISHED)->latest()->take(3)->get(['id', 'title', 'photo']),
            'ebooks' => module('Ebook') && isActive('Ebook') ? Ebook::where('status', Status::PUBLISHED)->latest()->take(3)->get(['id', 'title', 'thumb']) : [],
        ];

        return view('blog::frontend.index', $data);
    }

    public function detail()
    {
        $id = base64_decode(request()->blog);

        $blog = Blog::findOrFail($id);
        $blog->view = $blog->view + 1;
        $blog->save();

        $next = Blog::where('id', '>', $id)->oldest('id')->first(['id', 'title', 'slug', 'date']);
        $previous = Blog::where('id', '<', $id)->latest('id')->first(['id', 'title', 'slug', 'date']);

        $nextId = $next ? $next->id : 0;
        $previousId = $previous ? $previous->id : 0;

        $data = [
            'blog'     => $blog,
            'next'     => $next,
            'previous' => $previous,
            'tags'     => Blog::where('status', Status::PUBLISHED)->distinct('tag')->take(20)->get(['tag']),
            'blogs'    => Blog::where('status', Status::PUBLISHED)->whereNotIn('id', [$id, $previousId, $nextId])->latest('date')->take(9)->get(),

        ];

        return view('blog::frontend.detail', $data);
    }

    public function search()
    {
        $search = request()->search;

        $data = [
            'tags'   => Blog::where('status', Status::PUBLISHED)->distinct('tag')->take(20)->get(['tag']),
            'exams'  => Exam::where('status', Status::PUBLISHED)->latest()->take(3)->get(['id', 'title', 'photo']),
            'mcq'    => ModelTest::where('status', Status::PUBLISHED)->latest()->take(3)->get(['id', 'title', 'photo']),
            'blogs'  => Blog::where('status', Status::PUBLISHED)->where(fn($query) => [
                                $query->where('title', 'like', '%' . $search . '%')->orWhere('tag', 'like', '%' . $search . '%')
                            ])->latest('date')->paginate(20),
            'ebooks' => module('Ebook') && isActive('Ebook') ? Ebook::where('status', Status::PUBLISHED)->latest()->take(3)->get(['id', 'title', 'thumb']) : [],
        ];

        return view('blog::frontend.index', $data);
    }

    public function tag()
    {
        $tag = request()->tag;

        $data = [
            'tags'   => Blog::where('status', Status::PUBLISHED)->distinct('tag')->take(20)->get(['tag']),
            'exams'  => Exam::where('status', Status::PUBLISHED)->latest()->take(3)->get(['id', 'title', 'photo']),
            'mcq'    => ModelTest::where('status', Status::PUBLISHED)->latest()->take(3)->get(['id', 'title', 'photo']),
            'blogs'  => Blog::where('tag', 'like', '%' . $tag . '%')->where('status', Status::PUBLISHED)->latest('date')
                            ->paginate(20),
            'ebooks' => module('Ebook') && isActive('Ebook') ? Ebook::where('status', Status::PUBLISHED)->latest()
                            ->take(3)->get(['id', 'title', 'thumb']) : [],
        ];

        return view('blog::frontend.index', $data);
    }
}
