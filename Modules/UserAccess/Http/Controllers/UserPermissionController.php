<?php

namespace Modules\UserAccess\Http\Controllers;

use Modules\UserAccess\DataTables\UserPermissionsDataTable;
use Modules\Category\Entities\ChildCategory;
use Illuminate\Contracts\Support\Renderable;
use Modules\UserAccess\Entities\UserAccess;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserPermissionController extends Controller
{
    protected $userModelObject;

    public function __construct()
    {
        $this->userModelObject = new UserAccess();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(UserPermissionsDataTable $dataTable)
    {
        return $dataTable->render('useraccess::permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data = [
            'categories' => ChildCategory::orderBy('name', 'asc')->get(['id', 'name']),
            'users' => User::whereHas("roles", function ($q) {
                $q->where("name", "Writer");
            })->orderBy('name', 'asc')->get()
        ];

        return view('useraccess::permissions.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $this->userModelObject->storeAccess($request);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param UserAccess $access
     * @return Renderable
     */
    public function destroy(UserAccess $access)
    {
        $this->userModelObject->destroyAccess($access);
        return back();
    }
}
