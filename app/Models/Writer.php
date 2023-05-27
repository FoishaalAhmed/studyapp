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

class Writer extends Model
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

    public function storeWriter(Object $request)
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
                $storeWriter      = $this->save();

                $user= User::findOrFail($this->id);
                $user->assignRole($request->role_id);

                $storeWriter
                    ? session()->flash('success', 'New Writer Created Successfully!')
                    : session()->flash('error', 'Something Went Wrong!');
            });
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function updateWriter(Object $request, Object $user)
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
                $updateWriter     = $user->save();

                $writer = User::findOrFail($user->id);

                $writer->removeRole($writer->roles->first());
                $writer->assignRole($request->role_id);

                $updateWriter
                    ? session()->flash('success', 'Writer Updated Successfully!')
                    : session()->flash('error', 'Something Went Wrong!');
            });
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function destroyWriter(Object $user)
    {
        $user = User::findOrFail($user->id);
        if (file_exists($user->photo)) unlink($user->photo);
        $user->removeRole($user->roles->first());
        $destroyWriter = $user->delete();

        $destroyWriter
            ? session()->flash('success', 'Writer Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
