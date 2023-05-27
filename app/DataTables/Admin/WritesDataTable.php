<?php

namespace App\DataTables\Admin;

use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class WritesDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('name', function ($writer) {
                return $writer->name;
            })
            ->addColumn('email', function ($writer) {
                return $writer->email;
            })
            ->addColumn('phone', function ($writer) {
                return !empty($writer->phone) ? $writer->phone : '-';
            })
            ->addColumn('age', function ($writer) {
                return !empty($writer->age) ? $writer->age : '-';
            })
            ->addColumn('gender', function ($writer) {
                return !empty($writer->gender) ? $writer->gender : '-';
            })
            ->addColumn('action', function ($writer) {
                $edit = '<a href="' . route('admin.writers.edit', $writer->id) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-edit"></i></a>&nbsp;';
                $delete = '<a href="' . route('admin.writers.destroy', $writer->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
                return $edit . $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function query()
    {
        $query = User::whereHas("roles", function ($q) {
            $q->where("name", "Writer");
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
