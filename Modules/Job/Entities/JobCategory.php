<?php

namespace Modules\Job\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'photo'
    ];

    public function jobs()
    {

        return $this->hasMany(Job::class);
    }

    public function storeCategory(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {

            $response = uploadImage($image, 'public/images/jobCategory/', 'jobCategory', '465*260');

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $this->photo = 'public/images/jobCategory/' . $response['file_name'];
        }

        $this->name = $request->name;
        $storeCategory = $this->save();

        $storeCategory
            ? session()->flash('success', 'New Category Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateCategory(Object $request)
    {
        $category = $this::findOrFail($request->id);
        $image = $request->file('photo');

        if ($image) {

            $response = uploadImage($image, 'public/images/jobCategory/', 'jobCategory', '465*260', $category->photo);

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $category->photo = 'public/images/jobCategory/' . $response['file_name'];
        }

        $category->name = $request->name;
        $updateCategory = $category->save();

        $updateCategory
            ? session()->flash('success', 'Category Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyCategory(Object $category)
    {
        if (file_exists($category->photo)) unlink($category->photo);
        $destroyCategory = $category->delete();

        $destroyCategory
            ? session()->flash('success', 'Category Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
