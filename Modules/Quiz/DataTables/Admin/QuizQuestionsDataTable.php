<?php

namespace Modules\Quiz\DataTables\Admin;

use Illuminate\Http\JsonResponse;
use Modules\Quiz\Entities\QuizQuestion;
use Yajra\DataTables\Services\DataTable;

class QuizQuestionsDataTable extends DataTable
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
            ->addColumn('user_id', function ($question) {
                return  $question->user?->name;
            })
            ->rawColumns(['photo', 'action'])
            ->make(true);
    }

    public function query()
    {
        $quizId = request()->quiz_id;

        $query = $quizId 
            ? QuizQuestion::where('quiz_id', $quizId)->with('user:id,name')->latest() 
            : QuizQuestion::with('user:id,name')->latest();

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
                'name' => 'quiz_questions.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'question',
                'name' => 'quiz_questions.question',
                'title' => __('Question')
            ])
            ->addColumn([
                'data' => 'answer1',
                'name' => 'quiz_questions.answer1',
                'title' => __('Answer1')
            ])
            ->addColumn([
                'data' => 'answer2',
                'name' => 'quiz_questions.answer2',
                'title' => __('Answer2')
            ])
            ->addColumn([
                'data' => 'answer3',
                'name' => 'quiz_questions.answer3',
                'title' => __('Answer3')
            ])
            ->addColumn([
                'data' => 'answer4',
                'name' => 'quiz_questions.answer4',
                'title' => __('Answer4')
            ])
            ->addColumn([
                'data' => 'answer',
                'name' => 'quiz_questions.answer',
                'title' => __('Right Answer'),
                'searchable' => false,
            ])
            ->addColumn([
                'data' => 'user_id',
                'name' => 'user.name',
                'title' => __('Writer')
            ])
            ->parameters(dataTableOptions());
    }
}