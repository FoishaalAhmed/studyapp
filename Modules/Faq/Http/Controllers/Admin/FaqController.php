<?php

namespace Modules\Faq\Http\Controllers\Admin;

use Modules\Faq\Entities\Faq;
use Illuminate\Routing\Controller;
use Modules\Faq\DataTables\Admin\FaqsDataTable;

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
        return $dataTable->render('faq::admin.index');
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
