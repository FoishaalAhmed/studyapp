<?php

namespace Modules\Exam\DataTables\Writer;

use Illuminate\Http\JsonResponse;
use Modules\Exam\Entities\ExamQuestion;
use Yajra\DataTables\Services\DataTable;

class ExamQuestionsDataTable extends DataTable
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
            ->addColumn('correct_answer', function ($question) {
                return  $question->correct_answer;
            })
            ->addColumn('user_id', function ($question) {
                return  $question->user?->name;
            })
            ->addColumn('action', function ($question) {

                $edit = '<a href="' . route('writer.exam-questions.edit', $question->id) . '" class="btn btn-outline-info waves-effect waves-light"><i class="fe-edit"></i></a>&nbsp;';

                return $edit;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function query()
    {
        $examId = request()->exam_id;

        if ($examId) {
            $query = ExamQuestion::where('exam_id', $examId)->with('user:id,name');
        } else {
            $query = ExamQuestion::with('user:id,name');
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
                'name' => 'exam_questions.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'question',
                'name' => 'exam_questions.question',
                'title' => __('Question')
            ])
            ->addColumn([
                'data' => 'answer1',
                'name' => 'exam_questions.answer1',
                'title' => __('Answer1')
            ])
            ->addColumn([
                'data' => 'answer2',
                'name' => 'exam_questions.answer2',
                'title' => __('Answer2')
            ])
            ->addColumn([
                'data' => 'answer3',
                'name' => 'exam_questions.answer3',
                'title' => __('Answer3')
            ])
            ->addColumn([
                'data' => 'answer4',
                'name' => 'exam_questions.answer4',
                'title' => __('Answer4')
            ])
            ->addColumn([
                'data' => 'correct_answer',
                'name' => 'exam_questions.correct_answer',
                'title' => __('Right Answer'),
                'searchable' => false,
            ])
            ->addColumn([
                'data' => 'user_id',
                'name' => 'user.name',
                'title' => __('Writer')
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
