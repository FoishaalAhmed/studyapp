<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    private $profileObject;

    public function __construct()
    {
        $this->profileObject = new Profile();
    }

    public function photo(Request $request)
    {
        $request->validate(Profile::$validatePhotoRule);
        $this->profileObject->updateUserPhoto($request);
        return back();
    }

    public function password(Request $request)
    {
        $request->validate(Profile::$validatePasswordRule);
        $this->profileObject->updateUserPassword($request);
        return back();
    }

    public function info(ProfileRequest $request)
    {
        $this->profileObject->updateUserInfo($request);
        return back();
    }
}
