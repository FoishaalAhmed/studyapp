<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class AppHomePage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'type', 'categories'
    ];

    public static $validatedRules = [
        'title' => ['required', 'string', 'max:255'],
        'categories' => ['required'],
    ];

    public function storeAppHomePage(Object $request):void
    {
        try {
            DB::beginTransaction();

            foreach ($request->title as $key => $value) {

                if ($value == null) continue;

                $data[] = [
                    'title'      => $value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'type'       => $request->type[$key],
                    'common_for' => implode(',', $request->category_id),
                    'common_categories' => implode(',', $request->{$request->type[$key]}),
                ]; 
            }

            $storeAppHomePage = $this::insert($data);

            DB::commit();


            $storeAppHomePage
                ? session()->flash('success', 'App Home Page Data Created Successfully.')
                : session()->flash('error', 'Something Went Wrong.');

        } catch (\Exception $e) {

            DB::rollBack();

            session()->flash('error', json_encode($e->getMessage()));
        }
    }

    public function updateAppHomePage(Object $request, Object $appHome):void
    {
        $appHome->title             = $request->title;
        $appHome->common_for        = implode(',', $request->category_id);
        $appHome->common_categories = implode(',', $request->categories);
        $updateAppHomePage          = $appHome->save();

        $updateAppHomePage
            ? session()->flash('success', 'App Home Page Data Updated Successfully.')
            : session()->flash('error', 'Something Went Wrong.');
    }
}
