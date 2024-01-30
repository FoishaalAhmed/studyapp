<?php

namespace Modules\Ebook\Http\Controllers\Frontend;

use Modules\Ebook\Entities\Ebook;
use Illuminate\Routing\Controller;
use Modules\Subject\Entities\Subject;
use App\Enums\{CategoryType, Status};
use Modules\Category\Entities\ChildCategory;

class EbookController extends Controller
{
    public function index()
    {
        $categories = ChildCategory::where('sub_category_id', request()->category)->pluck('id')->toArray();

        $data = [
            'subjects' => Subject::withCount('ebooks')->latest('ebooks_count')->take(10)->get(),
            'ebooks'   => Ebook::withCount('buys')->with('subject:id,name')->whereIn('child_category_id', $categories)->where('status', Status::PUBLISHED)->latest()->paginate(16),
            'categories' => ChildCategory::withCount('ebooks')->where('sub_category_id', request()->category)->whereIn('type', [CategoryType:: Ebook, CategoryType::CommonEbook])->latest('ebooks_count')->take(10)->get(),
        ];

        return view('ebook::frontend.grid', $data);
    }

    public function list()
    {
        $categories = ChildCategory::where('sub_category_id', request()->category)->pluck('id')->toArray();

        $data = [
            'subjects' => Subject::withCount('ebooks')->latest('ebooks_count')->take(10)->get(),
            'ebooks'   => Ebook::withCount('buys')->with('subject:id,name')->whereIn('child_category_id', $categories)->where('status', Status::PUBLISHED)->latest()->paginate(16),
            'categories' => ChildCategory::withCount('ebooks')->where('sub_category_id', request()->category)->whereIn('type', [CategoryType:: Ebook, CategoryType::CommonEbook])->latest('ebooks_count')->take(10)->get(),
        ];

        return view('ebook::frontend.list', $data);
    }

    public function categoryEbook()
    {
        $categories = ChildCategory::where('id', request()->category)->pluck('sub_category_id')->toArray();

        $data = [
            'subjects' => Subject::withCount('ebooks')->latest('ebooks_count')->take(10)->get(),
            'ebooks'   => Ebook::withCount('buys')->with('subject:id,name')->where(['child_category_id' => request()->category, 'status' => Status::PUBLISHED])->latest()->paginate(16),
            'categories' => ChildCategory::withCount('ebooks')->whereIn('sub_category_id', $categories)->whereIn('type', [CategoryType:: Ebook, CategoryType::CommonEbook])->latest('ebooks_count')->take(10)->get()
        ];

        return request()->view == 'grid' ? view('ebook::frontend.grid', $data) : view('ebook::frontend.list', $data);
    }

    public function subjectEbook()
    {
        $categories = Ebook::where('subject_id', request()->subject)->pluck('child_category_id')->toArray();

        $data = [
            'subjects' => Subject::withCount('ebooks')->latest('ebooks_count')->take(10)->get(),
            'ebooks'   => Ebook::withCount('buys')->with('subject:id,name')->where(['subject_id' => request()->subject, 'status' => Status::PUBLISHED])->latest()->paginate(16),
            'categories' => ChildCategory::withCount('ebooks')->whereIn('id', $categories)->whereIn('type', [CategoryType:: Ebook, CategoryType::CommonEbook])->latest('ebooks_count')->take(10)->get()
        ];

        return request()->view == 'grid' ? view('ebook::frontend.grid', $data) : view('ebook::frontend.list', $data);

    }

    public function search()
    {
        $categories = Ebook::where('title', 'like', '%' . request()->search . '%')->pluck('child_category_id')->toArray();

        $data = [
            'subjects'   => Subject::withCount('ebooks')->latest('ebooks_count')->take(10)->get(),
            'ebooks'     => Ebook::where('title', 'like', '%' . request()->search . '%')->where('status', Status::PUBLISHED)->latest()->paginate(8),
            'categories' => ChildCategory::withCount('ebooks')->whereIn('id', $categories)->whereIn('type', [CategoryType:: Ebook, CategoryType::CommonEbook])->latest('ebooks_count')->take(10)->get(),
        ];

        return request()->view == 'grid' ? view('ebook::frontend.grid', $data) : view('ebook::frontend.list', $data);
    }

    public function detail()
    {
        $id    = base64_decode(request()->ebook);
        $ebook = Ebook::with(['category:id,name', 'subject:id,name'])->findOrFail($id);

        $data = [
            'ebook'    => $ebook,
            'subjects' => Subject::withCount('ebooks')->latest('ebooks_count')->take(10)->get(),
            'ebooks'   => Ebook::where('child_category_id', $ebook->child_category_id)->where('id', '!=', $id)->latest()->take(3)->get(),
        ];

        return view('ebook::frontend.detail', $data);
    }
}
