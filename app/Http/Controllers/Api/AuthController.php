<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegistrationRequest;
use App\Http\Requests\Api\SocialRegistrationRequest;
use App\Http\Requests\Api\UserCategoryRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\SocialLoginRequest;
use Illuminate\Support\Facades\Hash;
use Modules\Category\Entities\Category;
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

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || !Hash::check($request->password, $user->password)) {
            return $this->unprocessableResponse([], __('The provided credentials are incorrect.'));
        }

        $token = $user->createToken('myAppToken')->plainTextToken;

        $response = [
            'user_id' => $user->id,
            'token' => $token
        ];

        return $this->successResponse($response);
    }

    public function socialLogin(SocialLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (empty($user)) {
            return $this->unprocessableResponse([], __('The provided credentials are incorrect.'));
        }

        $token = $user->createToken('myAppToken')->plainTextToken;

        $response = [
            'user_id' => $user->id,
            'token' => $token
        ];

        return $this->successResponse($response);
    }

    public function category()
    {
        $categories = Category::oldest('name')->get(['id', 'name', 'photo']);
        return $this->successResponse($categories);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->successResponse(__('Logout Successful'));
    }
}
