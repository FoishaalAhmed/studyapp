<?php

namespace Modules\Mcq\DataTables\Admin;

use Illuminate\Http\JsonResponse;
use Modules\Mcq\Entities\ModelTest;
use Yajra\DataTables\Services\DataTable;

class ModelTestsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('child_category_id', function ($model) {
                return  $model->category?->name;
            })
            ->addColumn('subject_id', function ($model) {
                return $model->subject?->name;
            })
            ->addColumn('title', function ($model) {
                return '<a href="' . route('admin.questions.index', ['model_test_id' => $model->id]) . '">' . $model->title . '</a>';
            })
            ->addColumn('questions_count', function ($model) {
                return  $model->questions_count;
            })
            ->addColumn('time', function ($model) {
                return  $model->time;
            })
            ->addColumn('type', function ($model) {
                return  $model->type;
            })
            ->addColumn('photo', function ($model) {
                return '<img class="d-flex align-items-start rounded me-2" src="' . asset($model->photo) . '" alt="Category Photo" height="48">';
            })
            
            ->addColumn('action', function ($model) {

                $examCreate = '<a href="' . route('admin.exams.create', ["model_test_id" => $model->id]) . '" class="btn btn-outline-info waves-effect waves-light" title="'. __("New Exam") .'" tabindex="0" data-plugin="tippy" data-tippy-animation="shift-away" data-tippy-arrow="true"><i class="fe-plus-square"></i></a>&nbsp;';

                $status = $model->status == 'Published' ? '<a href="' . route('admin.mcqs.status', [$model->id, 'In Review']) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-thumbs-up "></i></a>&nbsp;' : '<a href="' . route('admin.mcqs.status', [$model->id, 'Published']) . '" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-thumbs-down"></i></a>&nbsp;';
                
                $edit = '<a href="' . route('admin.mcqs.edit', $model->id) . '" class="btn btn-outline-info waves-effect waves-light"><i class="fe-edit"></i></a>&nbsp;';

                $delete = '<a href="' . route('admin.mcqs.destroy', $model->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
                return $examCreate . $status . $edit . $delete;
            })
            ->rawColumns(['photo', 'title', 'action'])
            ->make(true);
    }

    public function query()
    {
        $categoryId = request()->category_id;
        $subjectId = request()->subject_id;

        if ($categoryId) {
            $query = ModelTest::where('child_category_id', $categoryId)->with(['category:id,name', 'subject:id,name'])->withCount('questions');
        } elseif ($subjectId) {
            $query = ModelTest::where('subject_id', $subjectId)->with(['category:id,name', 'subject:id,name'])->withCount('questions');
        } else {
            $query = ModelTest::with(['category:id,name', 'subject:id,name'])->withCount('questions');
        }
        
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
                'name' => 'model_tests.id',
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
                'name' => 'model_tests.title',
                'title' => __('Title')
            ])
            ->addColumn([
                'data' => 'questions_count',
                'name' => 'questions_count',
                'title' => __('Question'),
                'searchable' => false,
            ])
            ->addColumn([
                'data' => 'time',
                'name' => 'model_tests.time',
                'title' => __('Time')
            ])
            ->addColumn([
                'data' => 'type',
                'name' => 'model_tests.type',
                'title' => __('Type')
            ])
            ->addColumn([
                'data' => 'photo',
                'name' => 'model_tests.photo',
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
