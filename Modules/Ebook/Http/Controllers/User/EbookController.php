<?php

namespace Modules\Ebook\Http\Controllers\User;


use App\Models\Buy;
use Modules\Ebook\Entities\Ebook;
use Illuminate\Routing\Controller;
use App\Enums\{ContentType, Status, CategoryType};
use Modules\Category\Entities\{CategoryUser, SubCategory, ChildCategory};

class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categoryId = request()->category_id;
        $ebookIds = Buy::where(['type' => 'ebook', 'user_id' => auth()->id()])->pluck('resource_id')->toArray();

        $data = [
            'ebooks' => Ebook::with(['subject:id,name', 'category:id,name'])
                ->where(['child_Category_id' => $categoryId, 'status' => Status::PUBLISHED])
                ->where(function ($query) use ($ebookIds) {
                    $query->where('type', ContentType::FREE)->orWhereIn('id', $ebookIds);
                })->paginate(60)
        ];

        return view('ebook::user.index', $data);
    }

    /**
     * Show all subcategory of ebook for user
     * @return Renderable
     */

    public function allCategory()
    {
        $userCategories = CategoryUser::where('user_id', auth()->id())->pluck('category_id')->toArray();

        $data = [
            'ebookCategories' => SubCategory::withCount(['ebooks'])->whereIn('type', [CategoryType::Ebook, CategoryType::CommonEbook])->whereIn('category_id', $userCategories)->latest('ebooks_count')->paginate(30),
        ];

        return view('ebook::user.sub-category', $data);
    }

    /**
     * Show all subcategory of ebook for user
     * @return Renderable
     */

    public function category(SubCategory $category, string $name)
    {
        $data = [
            'ebookCategories' => ChildCategory::withCount(['ebooks'])->whereIn('type', [CategoryType::Ebook, CategoryType::CommonEbook])->where('sub_category_id', $category->id)->latest('ebooks_count')->paginate(30),
        ];

        return view('ebook::user.category', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Ebook $ebook
     * @return Renderable
     */
    public function read(Ebook $ebook)
    {
        return view('ebook::user.read', compact('ebook'));
    }

    public function download(Ebook $ebook)
    {
        if (!file_exists($ebook->book)) {
            session()->flash('error', 'Book does not exists!');
            return back();
        }

        return response()->download($ebook->book);
    }
}
