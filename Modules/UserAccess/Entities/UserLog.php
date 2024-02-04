<?php

namespace Modules\UserAccess\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'module',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function storeUserLog(Object $request)
    {
        $this->user_id = auth()->id();
        $this->module  = $request->module;
        $this->save();
    }

    public function destroyUserLog(Object $log)
    {
        $destroyUserLog = $log->delete();

        $destroyUserLog
            ? session()->flash('success', 'User Log Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
