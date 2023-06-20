<?php

namespace Modules\Testimonial\DataTables;

use Modules\Testimonial\Entities\Testimonial;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;
use Str;

class TestimonialsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('name', function ($testimonial) {
                return  $testimonial->name ;
            })
            ->addColumn('position', function ($testimonial) {
                return  $testimonial->position ;
            })
            ->addColumn('star', function ($testimonial) {
                return  $testimonial->star ;
            })
            ->addColumn('message', function ($testimonial) {
                return Str::limit(strip_tags($testimonial->message), 100)  ;
            })
            ->addColumn('photo', function ($testimonial) {
                return '<img class="d-flex align-items-start rounded me-2" src="' . asset($testimonial->photo) . '" alt="Category Photo" height="48">';
            })
            ->addColumn('action', function ($testimonial) {
                $status = $testimonial->status == 'Published' ? '<a href="' . route('admin.testimonials.status', [$testimonial->id, 'In Review']) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-thumbs-up "></i></a>&nbsp;' : '<a href="' . route('admin.testimonials.status', [$testimonial->id, 'Published']) . '" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-thumbs-down"></i></a>&nbsp;';

                $delete = '<a href="' . route('admin.testimonials.destroy', $testimonial->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';

                return $status . $delete;
            })
            ->rawColumns(['name', 'photo', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = Testimonial::latest();
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
                'name' => 'testimonials.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'name',
                'name' => 'testimonials.name',
                'title' => __('Name')
            ])
            ->addColumn([
                'data' => 'position',
                'name' => 'testimonials.position',
                'title' => __('Position')
            ])
            ->addColumn([
                'data' => 'star',
                'name' => 'testimonials.star',
                'title' => __('Star')
            ])
            ->addColumn([
                'data' => 'message',
                'name' => 'testimonials.message',
                'title' => __('Message')
            ])
            ->addColumn([
                'data' => 'photo',
                'name' => 'testimonials.photo',
                'title' => __('Photo')
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
