<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'child_category_id',
    ];

    public static $validateRule = [
        'user_id' => ['required', 'numeric', 'min:1'],
        'child_category_id' => ['required'],
    ];

    public function category()
    {
        return $this->belongsTo(ChildCategory::class, 'child_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function storeAccess(Object $request)
    {
        foreach ($request->child_category_id as $key => $value) {

            $data[] = [
                'child_category_id' => $value,
                'user_id' => $request->user_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        $this::insert($data);

        session()->flash('success', 'Permission Added Successfully!');
    }

    public function updateAccess(Object $request, Object $access)
    {
        $this::where('user_id', $request->user_id)->delete();
        foreach ($request->child_category_id as $key => $value) {

            $data[] = [
                'child_category_id' => $value,
                'user_id' => $request->user_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        $this::insert($data);

        session()->flash('success', 'Permission Updated Successfully!');
    }
}
