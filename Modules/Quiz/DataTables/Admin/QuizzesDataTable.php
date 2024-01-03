<?php

namespace Modules\Quiz\DataTables\Admin;

use Illuminate\Http\JsonResponse;
use Modules\Quiz\Entities\Quiz;
use Yajra\DataTables\Services\DataTable;

class QuizzesDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('category_id', function ($quiz) {
                return optional($quiz->category)->name;
            })
            ->addColumn('title', function ($quiz) {

                return '<a href="' . route('admin.quiz-questions.index', ['quiz_id' => $quiz->id]) . '">' . $quiz->title . '</a>';
            
            })
            ->addColumn('type', function ($quiz) {
                return $quiz->type;
            })
            ->addColumn('price', function ($quiz) {
                return $quiz->price;
            })
            ->addColumn('status', function ($quiz) {
                return $quiz->status;
            })
            ->addColumn('photo', function ($quiz) {
                return '<img class="d-flex align-items-start rounded me-2" src="' . asset($quiz->photo) . '" alt="Category Photo" height="48">';
            })
            ->addColumn('action', function ($quiz) {
                $status = $quiz->status == 'Published' ? '<a href="' . route('admin.quizzes.status', [$quiz->id, 'In Review']) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-thumbs-up "></i></a>&nbsp;' : '<a href="' . route('admin.quizzes.status', [$quiz->id, 'Published']) . '" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-thumbs-down"></i></a>&nbsp;';
                $edit = '<a href="' . route('admin.quizzes.edit', $quiz->id) . '" class="btn btn-outline-info waves-effect waves-light"><i class="fe-edit"></i></a>&nbsp;';
                $delete = '<a href="' . route('admin.quizzes.destroy', $quiz->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';

                return $status . $edit . $delete;
            })
            ->rawColumns(['title', 'photo', 'action'])
            ->make(true);
    }

    public function query()
    {
        $categoryId = request()->category_id;

        $query = $categoryId 
            ? Quiz::where('category_id', $categoryId)->with('category:id,name')->latest() 
            : Quiz::with('category:id,name')->latest();

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
                'name' => 'quizzes.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'category_id',
                'name' => 'category.name',
                'title' => __('Category')
            ])
            ->addColumn([
                'data' => 'title',
                'name' => 'quizzes.title',
                'title' => __('Title')
            ])
            ->addColumn([
                'data' => 'type',
                'name' => 'quizzes.type',
                'title' => __('Type')
            ])
            ->addColumn([
                'data' => 'price',
                'name' => 'quizzes.price',
                'title' => __('Price')
            ])
            ->addColumn([
                'data' => 'status',
                'name' => 'quizzes.status',
                'title' => __('Status')
            ])
            ->addColumn([
                'data' => 'photo',
                'name' => 'quizzes.photo',
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