<?php

namespace Modules\Testimonial\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'position', 'star', 'message', 'photo',
    ];

    public function storeTestimonial(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {

            $response = uploadFile($image, 'public/images/testimonials/', 'testimonial');

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $this->photo = 'public/images/testimonials/' . $response['file_name'];
        }

        $this->name       = $request->name;
        $this->star       = $request->star;
        $this->message    = $request->message;
        $this->position   = $request->position;
        $this->user_id    = auth()->id();
        $storeTestimonial = $this->save();

        $storeTestimonial
            ? session()->flash('success', 'New Testimonial Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateTestimonial(Object $request, Object $testimonial)
    {
        $image = $request->file('photo');

        if ($image) {

            $response = uploadFile($image, 'public/images/testimonials/', 'testimonial', $testimonial->photo);

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $testimonial->photo = 'public/images/testimonials/' . $response['file_name'];
        }

        $testimonial->name     = $request->name;
        $testimonial->star     = $request->star;
        $testimonial->message  = $request->message;
        $testimonial->position = $request->position;
        $testimonial->user_id  = auth()->id();
        $updateTestimonial     = $testimonial->save();

        $updateTestimonial
            ? session()->flash('success', 'Testimonial Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyTestimonial(Object $testimonial)
    {
        if (file_exists($testimonial->photo)) unlink($testimonial->photo);

        $destroyTestimonial = $testimonial->delete();

        $destroyTestimonial
            ? session()->flash('success', 'Testimonial Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
