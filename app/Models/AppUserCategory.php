<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppUserCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'title', 'type', 'categories'
    ];

    public static $validatedRules = [
        'category_id' => ['required', 'numeric'],
        'title'       => ['required', 'string', 'max:255'],
        'categories'  => ['required'],
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function storeAppUserCategory(Object $request): void
    {
        try {

            DB::beginTransaction();

            foreach ($request->title as $key => $value) {

                if ($value == null) continue;

                $category = $this::where(['category_id' => $request->category_id, 'type' => $request->type[$key]])->first();

                if (is_null($category)) {
                    $data[] = [
                        'category_id' => $request->category_id,
                        'title'       => $value,
                        'type'        => $request->type[$key],
                        'categories'  => implode(',', $request->{$request->type[$key]}),
                        'created_at'  => date('Y-m-d H:i:s'),
                        'updated_at'  => date('Y-m-d H:i:s'),
                    ];

                } else {
                    $category->categories = $category->categories . ', ' . implode(',', $request->{$request->type[$key]});
                    $category->save();
                }
            }

            $storeAppHomePage = isset($data) ? $this::insert($data) : true;

            DB::commit();

            $storeAppHomePage
                ? session()->flash('success', 'App User Category Data Created Successfully.')
                : session()->flash('error', 'Something Went Wrong.');

        } catch (\Exception $e) {

            DB::rollBack();
            session()->flash('error', json_encode($e->getMessage()));
        }
    }

    public function updateUserCategory(Object $request, Object $appUserCategory): void
    {
        $appUserCategory->category_id = $request->category_id;
        $appUserCategory->title       = $request->title;
        $appUserCategory->categories  = implode(',', $request->categories);
        $updateAppUserCategory        = $appUserCategory->save();

        $updateAppUserCategory
            ? session()->flash('success', 'App User Category Data Updated Successfully.')
            : session()->flash('error', 'Something Went Wrong.');
    }
}
