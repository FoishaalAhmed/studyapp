<?php

namespace Modules\Testimonial\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'position', 'star', 'message', 'photo',
    ];

    public static $validateRule = [
        'name' => ['string', 'max: 255', 'required'],
        'position' => ['string', 'max: 255', 'required'],
        'message' => ['string', 'required', 'max: 250',],
        'star' => ['numeric', 'max: 5', 'min:1', 'required'],
        'photo'  => ['mimes:jpeg,jpg,png,gif,webp', 'max:500', 'nullable'],
    ];

    public function storeTestimonial(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->extension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/testimonials/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $this->photo     = $image_url;
        }

        $this->name       = $request->name;
        $this->position   = $request->position;
        $this->star       = $request->star;
        $this->message    = $request->message;
        $storeTestimonial = $this->save();

        $storeTestimonial
            ? session()->flash('success', 'New Testimonial Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateTestimonial(Object $request, Object $testimonial)
    {
        $image = $request->file('photo');

        if ($image) {
            if (file_exists($testimonial->photo)) unlink($testimonial->photo);
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->extension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/testimonials/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $testimonial->photo     = $image_url;
        }

        $testimonial->name     = $request->name;
        $testimonial->position = $request->position;
        $testimonial->star     = $request->star;
        $testimonial->message  = $request->message;
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
