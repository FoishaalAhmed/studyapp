<?php

namespace Modules\Quiz\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Quiz\DataTables\Admin\QuizQuestionsDataTable;

class QuizQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(QuizQuestionsDataTable $dataTables)
    {
        return $dataTables->render('quiz::admin.quiz-questions.index');
    }
}
