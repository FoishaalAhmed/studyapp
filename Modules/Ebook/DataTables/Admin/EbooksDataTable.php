<?php

namespace Modules\Ebook\DataTables\Admin;

use Illuminate\Http\JsonResponse;
use Modules\Ebook\Entities\Ebook;
use Yajra\DataTables\Services\DataTable;

class EbooksDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('child_category_id', function ($ebook) {
                return  $ebook->category?->name;
            })
            ->addColumn('subject_id', function ($ebook) {
                return $ebook->subject?->name;
            })
            ->addColumn('title', function ($ebook) {
                return  $ebook->title;
            })
            ->addColumn('thumb', function ($ebook) {
                return '<img class="d-flex align-items-start rounded me-2" src="' . asset($ebook->thumb) . '" alt="Category Thumb" height="48">';
            })
            ->addColumn('book', function ($ebook) {
                return '<a href="' . route('admin.ebooks.download', $ebook->id) . '" class= "btn btn-soft-primary rounded-pill waves-effect waves-light"><i class= "fe-download"></i></a>';
            })
            ->addColumn('action', function ($ebook) {
                $status = $ebook->status == 'Published' ? '<a href="' . route('admin.ebooks.status', [$ebook->id, 'In Review']) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-thumbs-up "></i></a>&nbsp;' : '<a href="' . route('admin.ebooks.status', [$ebook->id, 'Published']) . '" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-thumbs-down"></i></a>&nbsp;';

                $edit = '<a href="' . route('admin.ebooks.edit', $ebook->id) . '" class="btn btn-outline-info waves-effect waves-light"><i class="fe-edit"></i></a>&nbsp;';

                $delete = '<a href="' . route('admin.ebooks.destroy', $ebook->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
                return $status . $edit . $delete;
            })
            ->rawColumns(['thumb', 'book', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = Ebook::with(['category:id,name', 'subject:id,name']);
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
                'name' => 'ebooks.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'child_category_id',
                'name' => 'category.name',
                'title' => __('Category')
            ])
            ->addColumn([
                'data' => 'subject_id',
                'name' => 'subject.name',
                'title' => __('Subject')
            ])
            ->addColumn([
                'data' => 'title',
                'name' => 'ebooks.title',
                'title' => __('Title')
            ])
            ->addColumn([
                'data' => 'thumb',
                'name' => 'ebooks.thumb',
                'title' => __('Thumb')
            ])
            ->addColumn([
                'data' => 'book',
                'name' => 'ebooks.book',
                'title' => __('Ebook')
            ])
            ->addColumn([
                'data' => 'type',
                'name' => 'ebooks.type',
                'title' => __('Type')
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
