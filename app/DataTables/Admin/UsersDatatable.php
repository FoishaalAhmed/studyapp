<?php

namespace App\DataTables\Admin;

use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class UsersDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('name', function ($user) {
                return $user->name;
            })
            ->addColumn('email', function ($user) {
                return $user->email;
            })
            ->addColumn('phone', function ($user) {
                return !empty($user->phone) ? $user->phone : '-';
            })
            ->addColumn('age', function ($user) {
                return !empty($user->age) ? $user->age : '-';
            })
            ->addColumn('gender', function ($user) {
                return !empty($user->gender) ? $user->gender : '-';
            })
            ->addColumn('action', function ($user) {
                $edit = '<a href="' . route('admin.users.edit', $user->id) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-edit"></i></a>&nbsp;';
                $delete = '<a href="' . route('admin.users.destroy', $user->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
                return $edit . $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function query()
    {
        $query = User::whereHas("roles", function ($q) {
            $q->where("name", "User");
        })->orderBy('name', 'asc');
        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->addIndex([
                'data' => 'DT_RowIndex',
                'name' => 'DT_RowIndex',
                'title' => 'Sl',
                'searchable' => false,
            ])
            ->addColumn([
                'data' => 'id', 
                'name' => 'users.id', 
                'title' => __('ID'), 
                'searchable' => false, 
                'visible' => false
            ])
            ->addColumn([
                'data' => 'name', 
                'name' => 'users.name', 
                'title' => __('Name')
            ])
            ->addColumn([
                'data' => 'email', 
                'name' => 'users.email', 
                'title' => __('Email')
            ])
            ->addColumn([
                'data' => 'phone', 
                'name' => 'users.phone', 
                'title' => __('Phone')
            ])
            ->addColumn([
                'data' => 'age', 
                'name' => 'users.age', 
                'title' => __('Age')
            ])
            ->addColumn([
                'data' => 'gender', 
                'name' => 'users.gender', 
                'title' => __('Gender')
            ])
            ->addColumn([
                'data' => 'action', 
                'name' => 'action', 
                'title' => __('Action'), 
                'orderable' => false, 
                'searchable' => false
            ])
            ->parameters(dataTableOptions());
    }
}
