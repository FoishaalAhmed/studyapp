<?php

namespace Modules\Testimonial\Http\Controllers\Writer;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Testimonial\Entities\Testimonial;
use Modules\Testimonial\DataTables\Writer\TestimonialsDataTable;

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
        return $dataTable->render('testimonial::writer.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('testimonial::writer.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $this->testimonialModelObject->storeTestimonial($request);
        return redirect()->route('writer.testimonials.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Testimonial $testimonial
     * @return Renderable
     */
    public function edit(Testimonial $testimonial)
    {
        return view('testimonial::writer.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Testimonial $testimonial
     * @return Renderable
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $this->testimonialModelObject->updateTestimonial($request, $testimonial);
        return redirect()->route('writer.testimonials.index');
    }
}
