<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Modules\Category\Entities\{
    CategoryUser,
    Category
};
class UserController extends Controller
{
    protected $userModelObject;

    public function __construct()
    {
        $this->userModelObject = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'role' => Role::where('name', 'User')->first(['id', 'name']),
            'categories' => Category::orderBy('name', 'asc')->get(['id', 'name'])
        ];
        
        return view('backend.admin.users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->userModelObject->storeUser($request);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  object  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data = [
            'user' => $user,
            'role' => Role::where('name', 'User')->first(['id', 'name']),
            'categories' => Category::orderBy('name', 'asc')->get(['id', 'name']),
            'categoryArray' => CategoryUser::where('user_id', $user->id)->pluck('category_id')->toArray()
        ];
        
        return view('backend.admin.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  object  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->userModelObject->updateUser($request, $user);
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userModelObject->destroyUser($user);
        return back();
    }
}
