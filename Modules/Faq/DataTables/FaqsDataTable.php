<?php

namespace Modules\Faq\DataTables;

use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;
use Modules\Faq\Entities\Faq;
use Str;

class FaqsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('question', function ($faq) {
                return $faq->question;
            })
            ->addColumn('answer', function ($faq) {
                return Str::limit($faq->answer, 100);
            })
            ->addColumn('action', function ($faq) {
                return '<a href="' . route('admin.faqs.destroy', $faq->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function query()
    {
        $query = Faq::select('*');
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
                'name' => 'faqs.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'question',
                'name' => 'faqs.question',
                'title' => __('Question')
            ])
            ->addColumn([
                'data' => 'answer',
                'name' => 'faqs.answer',
                'title' => __('Answer')
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
