<?php

namespace Modules\Mcq\DataTables\Writer;

use Illuminate\Http\JsonResponse;
use Modules\Mcq\Entities\Question;
use Yajra\DataTables\Services\DataTable;

class QuestionsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('question', function ($question) {
                return  $question->question;
            })
            ->addColumn('answer1', function ($question) {
                return  $question->answer1;
            })
            ->addColumn('answer2', function ($question) {
                return  $question->answer2;
            })
            ->addColumn('answer3', function ($question) {
                return  $question->answer3;
            })
            ->addColumn('answer4', function ($question) {
                return  $question->answer4;
            })
            ->addColumn('answer', function ($question) {
                return  $question->answer;
            })
            ->addColumn('action', function ($question) {

                return '<a href="' . route('writer.mcq-questions.edit', $question->id) . '" class="btn btn-outline-info waves-effect waves-light"><i class="fe-edit"></i></a>';
            })
            ->rawColumns(['photo', 'action'])
            ->make(true);
    }

    public function query()
    {
        $modelTestId = request()->model_test_id;

        if ($modelTestId) {
            $query = Question::where('model_test_id', $modelTestId);
        } else {
            $query = Question::select('*');
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
                'name' => 'questions.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'question',
                'name' => 'questions.question',
                'title' => __('Question')
            ])
            ->addColumn([
                'data' => 'answer1',
                'name' => 'questions.answer1',
                'title' => __('Answer1')
            ])
            ->addColumn([
                'data' => 'answer2',
                'name' => 'questions.answer2',
                'title' => __('Answer2')
            ])
            ->addColumn([
                'data' => 'answer3',
                'name' => 'questions.answer3',
                'title' => __('Answer3')
            ])
            ->addColumn([
                'data' => 'answer4',
                'name' => 'questions.answer4',
                'title' => __('Answer4')
            ])
            ->addColumn([
                'data' => 'answer',
                'name' => 'questions.answer',
                'title' => __('Right Answer'),
                'searchable' => false,
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
