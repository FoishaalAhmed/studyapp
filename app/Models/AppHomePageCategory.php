<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppHomePageCategory extends Model
{
    use HasFactory;

    public static $validatedRules = [
        'sub_category_id' => ['required', 'numeric'],
        'title'           => ['required', 'string', 'max:255'],
        'categories'      => ['required'],
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function storeAppHomePageCategory(Object $request): void
    {
        try {

            DB::beginTransaction();

            foreach ($request->title as $key => $value) {

                if ($value == null) continue;

                $data[] = [
                    'sub_category_id' => $request->sub_category_id[$key],
                    'title'           => $value,
                    'type'            => $request->type[$key],
                    'categories'      => implode(',', $request->{$request->type[$key]}),
                    'created_at'      => date('Y-m-d H:i:s'),
                    'updated_at'      => date('Y-m-d H:i:s'),
                ];
            }

            $storeAppHomePage = $this::insert($data);

            DB::commit();

            $storeAppHomePage
                ? session()->flash('success', 'App Home Page Category Data Created Successfully.')
                : session()->flash('error', 'Something Went Wrong.');

        } catch (\Exception $e) {

            DB::rollBack();

            session()->flash('error', json_encode($e->getMessage()));
        }
    }

    public function updateAppHomePageCategory(Object $request, Object $appHomePageCategory): void
    {
        $appHomePageCategory->sub_category_id = $request->sub_category_id;
        $appHomePageCategory->title           = $request->title;
        $appHomePageCategory->categories      = implode(',', $request->categories);
        $updateAppHomePageCategory            = $appHomePageCategory->save();

        $updateAppHomePageCategory
            ? session()->flash('success', 'App Home Page Category Data Updated Successfully.')
            : session()->flash('error', 'Something Went Wrong.');
    }
}
