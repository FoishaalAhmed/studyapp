<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\AdminsDataTable;
use App\Http\Requests\AdminRequest;
use Spatie\Permission\Models\Role;
use App\Models\Admin;

class AdminController extends Controller
{
    protected $adminModelObject;

    public function __construct()
    {
        $this->adminModelObject = new Admin();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminsDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::where('name', 'Admin')->first(['id', 'name']);
        return view('backend.admin.admins.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $this->adminModelObject->storeAdmin($request);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  object  Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $data = [
            'admin' => $admin,
            'role' => Role::where('name', 'Admin')->first(['id', 'name'])
        ];
        return view('backend.admin.admins.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  object Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        $this->adminModelObject->updateAdmin($request, $admin);
        return redirect()->route('admin.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $this->adminModelObject->destroyAdmin($admin);
        return back(); 
    }
}
