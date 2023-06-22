<?php

namespace Modules\Faq\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\Faq\DataTables\FaqsDataTable;
use Illuminate\Routing\Controller;
use Modules\Faq\Entities\Faq;
use Illuminate\Http\Request;

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
        return $dataTable->render('faq::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('faq::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('faq::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('faq::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param Faq $faq
     * @return Renderable
     */
    public function destroy(Faq $faq)
    {
        $this->faqModelObject->destroyFaq($faq);
        return back();
    }
}
