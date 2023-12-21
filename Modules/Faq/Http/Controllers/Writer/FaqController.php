<?php

namespace Modules\Faq\Http\Controllers\Writer;

use Modules\Faq\Entities\Faq;
use Illuminate\Routing\Controller;
use Modules\Faq\Http\Requests\FaqRequest;
use Modules\Faq\DataTables\Writer\FaqsDataTable;

class FaqController extends Controller
{
    protected $faqModelObject;

    public function __construct()
    {
        $this->faqModelObject = new Faq();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(FaqsDataTable $dataTable)
    {
        return $dataTable->render('faq::writer.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('faq::writer.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(FaqRequest $request)
    {
        $this->faqModelObject->storeFaq($request);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param \Modules\Category\Entities\ChildCategory $childCategory
     * @return Renderable
     */
    public function edit(Faq $faq)
    {
        $data = [
            'faq' => $faq,
        ];
        return view('faq::writer.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param FaqRequest $request
     * @param Faq $faq
     * @return Renderable
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        $this->faqModelObject->updateFaq($request, $faq);
        return redirect()->route('writer.faqs.index');
    }
}
