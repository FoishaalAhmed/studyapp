<?php

namespace Modules\Testimonial\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Testimonial\Entities\Testimonial;
use Modules\Testimonial\DataTables\Admin\TestimonialsDataTable;

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
        return $dataTable->render('testimonial::admin.index');
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
