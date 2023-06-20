<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'phone', 'facebook', 'twitter', 'instagram', 'linkedin', 'address', 'map'
    ];

    public static $validateRule = [

        'email'     => 'required|email|max:255',
        'phone'     => 'required|string|max:15',
        'linkedin'  => 'nullable|string|max:255',
        'facebook'  => 'nullable|string|max:255',
        'twitter'   => 'nullable|string|max:255',
        'instagram' => 'nullable|string|max:255',
        'pinterest' => 'nullable|string|max:255',
        'address'   => 'required|string|max:255',
        'map'       => 'nullable|string',
    ];

    public function updateContact(Object $request, Object $contact)
    {
        $contact->email     = $request->email;
        $contact->phone     = $request->phone;
        $contact->facebook  = $request->facebook;
        $contact->twitter   = $request->twitter;
        $contact->instagram = $request->instagram;
        $contact->pinterest = $request->pinterest;
        $contact->linkedin  = $request->linkedin;
        $contact->address   = $request->address;
        $contact->map       = $request->map;
        $updateContact      = $contact->save();

        $updateContact ?
            session()->flash('success', 'Contact Updated Successfully!') :
            session()->flash('error', 'Something Went Wrong!');
    }
}
