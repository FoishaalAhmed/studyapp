<?php

namespace Modules\Testimonial\Http\Controllers;

use Modules\Testimonial\DataTables\TestimonialsDataTable;
use Modules\Testimonial\Entities\Testimonial;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    protected $testimonialModelObject;

    public function __construct()
    {
        $this->testimonialModelObject = new Testimonial();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(TestimonialsDataTable $dataTable)
    {
        return $dataTable->render('testimonial::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('testimonial::create');
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
        return view('testimonial::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('testimonial::edit');
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
     * @param Testimonial $testimonial
     * @return Renderable
     */
    public function destroy(Testimonial $testimonial)
    {
        $this->testimonialModelObject->destroyTestimonial($testimonial);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Testimonial $testimonial
     * @param string $status
     * @return Renderable
     */

    public function status(Testimonial $testimonial, string $status)
    {
        $testimonial->status = $status;
        $testimonialStatus = $testimonial->save();

        $testimonialStatus
            ? session()->flash('success', 'Testimonial Status Changed Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
        return back();
    }
}
