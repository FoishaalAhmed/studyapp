<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Laravel\Sanctum\HasApiTokens;
use Exception, DB;

class Admin extends Model
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
        'present_address',
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

    protected $table = 'users';

    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    public function storeAdmin(Object $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $this->name      = $request->name;
                $this->email     = $request->email;
                $this->phone     = $request->phone;
                $this->age       = $request->age;
                $this->gender    = $request->gender;
                $this->present_address   = $request->present_address;
                $this->permanent_address   = $request->permanent_address;
                $this->password  = Hash::make($request->password);
                $storeAdmin      = $this->save();

                $user= User::findOrFail($this->id);
                $user->assignRole($request->role_id);

                $storeAdmin
                    ? session()->flash('success', 'New Admin Created Successfully!')
                    : session()->flash('error', 'Something Went Wrong!');
            });
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function updateAdmin(Object $request, Object $user)
    {
        try {
            DB::transaction(function () use ($request, $user) {
                $user->name      = $request->name;
                $user->email     = $request->email;
                $user->phone     = $request->phone;
                $user->age       = $request->age;
                $user->gender    = $request->gender;
                $user->present_address   = $request->present_address;
                $user->permanent_address   = $request->permanent_address;
                $updateAdmin     = $user->save();

                $admin = User::findOrFail($user->id);

                $admin->removeRole($admin->roles->first());
                $admin->assignRole($request->role_id);

                $updateAdmin
                    ? session()->flash('success', 'Admin Updated Successfully!')
                    : session()->flash('error', 'Something Went Wrong!');
            });
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function destroyAdmin(Object $user)
    {
        $user = User::findOrFail($user->id);
        if (file_exists($user->photo)) unlink($user->photo);
        $user->removeRole($user->roles->first());
        $destroyAdmin = $user->delete();

        $destroyAdmin
            ? session()->flash('success', 'Admin Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
