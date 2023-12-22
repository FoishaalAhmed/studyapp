<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use DB, Exception;
use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Log
};
use Modules\Category\Entities\{
    CategoryUser,
    Category
};

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $categories = Category::select('id', 'name')->get();
        return view('auth.register', compact('categories'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:15', 'unique:users'],
            'age' => ['required', 'numeric'],
            'gender' => ['required', 'string', Rule::in(['Male', 'Female']),],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {

            DB::BeginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'age' => $request->age,
                'gender' => $request->gender,
                'password' => Hash::make($request->password),
            ]);

            foreach ($request->category as $value) {
                $categoryData[] = [
                    'user_id' => $user->id,
                    'category_id' => $value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }

            CategoryUser::insert($categoryData);

            $role = Role::where('name', 'User')->first();
            $user->assignRole($role);

            event(new Registered($user));

            Auth::login($user);

            DB::commit();

            return redirect(RouteServiceProvider::HOME);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info('registration log');
            Log::info($e->getMessage());
            return back()->withErrors('Something Went Wrong Please try again');
        }
    }
}
