<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Exception;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'preset_address',
        'permanent_address',
        'photo',
        'premium',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function categories()
    {

        return $this->hasManyThrough(ChildCategory::class, UserAccess::class);
    }

    public function storeUser(Object $request)
    {
        try {
            DB::transaction(function () use ($request) {
                
                $this->name      = $request->name;
                $this->email     = $request->email;
                $this->phone     = $request->phone;
                $this->age       = $request->age;
                $this->gender   = $request->gender;
                $this->present_address   = $request->present_address;
                $this->permanent_address   = $request->permanent_address;
                $this->password  = Hash::make($request->password);
                $userStore       = $this->save();

                foreach ($request->category as $key => $value) {
                    $categoryData[] = [
                        'user_id' => $this->id,
                        'category_id' => $value,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                }

                \Modules\Category\Entities\CategoryUser::insert($categoryData);

                $user = $this::findOrFail($this->id);
                $user->assignRole($request->role_id);

                $userStore
                    ? session()->flash('success', 'New User Created Successfully!')
                    : session()->flash('error', 'Something Went Wrong!');
            });
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        
    }

    public function updateUser(Object $request, Object $user)
    {
        try {
            DB::transaction(function () use ($request, $user) {
                $user->name      = $request->name;
                $user->email     = $request->email;
                $user->phone     = $request->phone;
                $user->age       = $request->age;
                $user->gender   = $request->gender;
                $user->present_address   = $request->present_address;
                $user->permanent_address   = $request->permanent_address;
                $userUpdate      = $user->save();

                foreach ($request->category as $key => $value) {
                    $categoryData[] = [
                        'user_id' => $user->id,
                        'category_id' => $value,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                }
                \Modules\Category\Entities\CategoryUser::where('user_id', $user->id)->delete();
                \Modules\Category\Entities\CategoryUser::insert($categoryData);

                $userUpdate
                    ? session()->flash('success', 'User Updated Successfully!')
                    : session()->flash('error', 'Something Went Wrong!');
            });
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        
    }

    public function destroyUser(Object $user)
    {
        if (file_exists($user->photo)) unlink($user->photo);
        $user->removeRole($user->roles->first());
        $userDelete = $user->delete();

        $userDelete
            ? session()->flash('success', 'User Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
