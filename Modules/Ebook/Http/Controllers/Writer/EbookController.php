<?php

namespace Modules\Ebook\Http\Controllers\Writer;

use App\Enums\CategoryType;
use Illuminate\Http\Request;
use Modules\Ebook\Entities\Ebook;
use Illuminate\Routing\Controller;
use Modules\Ebook\Http\Requests\EbookRequest;
use Modules\Ebook\DataTables\Writer\EbooksDataTable;
use Modules\Subject\Entities\{CategorySubject, Subject};
use Modules\Category\Entities\{ChildCategory, SubCategory};

class EbookController extends Controller
{
    protected $ebookModelObject;

    public function __construct(Ebook $ebookModelObject)
    {
        $this->ebookModelObject = $ebookModelObject;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(EbooksDataTable $dataTable)
    {
        return $dataTable->render('ebook::writer.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $subCategoryIds = SubCategory::where('type', CategoryType::Ebook)->pluck('id')->toArray();

        $data = [
            'categories' => ChildCategory::whereIn('sub_category_id', $subCategoryIds)->oldest('name')->get(['id', 'name'])
        ];
        return view('ebook::writer.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(EbookRequest $request)
    {
        $this->ebookModelObject->storeEbook($request);
        return redirect()->route('writer.ebooks.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Ebook $ebook)
    {
        $subCategoryIds = SubCategory::where('type', CategoryType::Ebook)->pluck('id')->toArray();
        $category = SubCategory::whereIn('id', $subCategoryIds)->firstOrFail(['category_id']);
        $category_ids = CategorySubject::where('category_id', $category->category_id)->pluck('subject_id')->toArray();

        $data = [
            'ebook' => $ebook,
            'categories' => ChildCategory::whereIn('sub_category_id', $subCategoryIds)->oldest('name')->get(['id', 'name']),
            'subjects' => Subject::whereIn('id', $category_ids)->oldest('name')->get(['id', 'name'])
        ];

        return view('ebook::writer.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param EbookRequest $request
     * @param Ebook $ebook
     * @return \Illuminate\Http\Response
     */
    public function update(EbookRequest $request, Ebook $ebook)
    {
        $this->ebookModelObject->updateEbook($request, $ebook);
        return redirect()->route('writer.ebooks.index');
    }


    public function show(Ebook $ebook)
    {

        if (!file_exists($ebook->book)) {
            session()->flash('error', 'Book does not exists!');
            return back();
        }

        return response()->download($ebook->book);
    }
}
