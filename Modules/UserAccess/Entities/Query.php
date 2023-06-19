<?php

namespace Modules\UserAccess\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'subject', 'message'
    ];

    public function storeQuery(Object $request)
    {
        $this->name = $request->name;
        $this->email = $request->email;
        $this->phone = $request->phone;
        $this->subject = $request->subject;
        $this->message = $request->message;
        $this->save();
    }

    public function destroyQuery(Object $query)
    {
        $destroyQuery = $query->delete();

        $destroyQuery
            ? session()->flash('success', 'Query Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
