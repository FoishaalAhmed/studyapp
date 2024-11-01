<?php

namespace Modules\Ebook\Http\Controllers\Admin;

use App\Enums\CategoryType;
use Modules\Ebook\Entities\Ebook;
use Illuminate\Routing\Controller;
use Modules\Ebook\Http\Requests\EbookRequest;
use Modules\Ebook\DataTables\Admin\EbooksDataTable;
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
        return $dataTable->render('ebook::admin.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Ebook $ebook)
    {
        $ids = SubCategory::whereIn('type', [CategoryType::Ebook, CategoryType::CommonEbook])->pluck('id')->toArray();
        $category = SubCategory::whereIn('id', $ids)->firstOrFail(['category_id']);
        $category_ids = CategorySubject::where('category_id', $category->category_id)->pluck('subject_id')->toArray();

        $data = [
            'ebook' => $ebook,
            'categories' => ChildCategory::whereIn('sub_category_id', $ids)->oldest('name')->get(['id', 'name']),
            'subjects' => Subject::whereIn('id', $category_ids)->oldest('name')->get(['id', 'name'])
        ];

        return view('ebook::admin.edit', $data);
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
        return redirect()->route('admin.ebooks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ebook $ebook)
    {
        $this->ebookModelObject->destroyEbook($ebook);
        return back();
    }

    public function status(Ebook $ebook, string $status)
    {
        $ebook->status = $status;
        $ebookStatus = $ebook->save();

        $ebookStatus
            ? session()->flash('success', 'Ebook Status Changed Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
        return back();
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
