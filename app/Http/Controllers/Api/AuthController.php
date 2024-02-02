<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegistrationRequest;
use App\Http\Requests\Api\SocialRegistrationRequest;
use App\Http\Requests\Api\UserCategoryRequest;
use Modules\Category\Entities\CategoryUser;

class AuthController extends Controller
{
    public function registration(RegistrationRequest $request)
    {
        try {
            return $this->successResponse((new User)->storeUserInfo($request));
        } catch (\Exception $exception) {
            return $this->unprocessableResponse([], $exception->getMessage());
        }
    }

    public function storeUserCategories(UserCategoryRequest $request)
    {
        try {
            (new CategoryUser)->storeUserCategories($request);
            return $this->successResponse();
        } catch (\Exception $exception) {
            return $this->unprocessableResponse([], $exception->getMessage());
        }
    }

    public function socialRegistration(SocialRegistrationRequest $request)
    {
        try {
            return $this->successResponse((new User)->storeUserSocialRegistrationInfo($request));
        } catch (\Exception $exception) {
            return $this->unprocessableResponse([], $exception->getMessage());
        }
    }
}
