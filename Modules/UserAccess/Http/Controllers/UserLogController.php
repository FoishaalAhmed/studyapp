<?php

namespace Modules\UserAccess\Http\Controllers;

use Modules\UserAccess\DataTables\WriterLogsDataTable;
use Modules\UserAccess\DataTables\UserLogsDataTable;
use Illuminate\Contracts\Support\Renderable;
use Modules\UserAccess\Entities\UserLog;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Modules\Category\Entities\{
    ChildCategory,
    SubCategory
};
use Modules\Exam\Entities\Exam;
use Modules\Exam\Entities\ExamQuestion;
use Modules\Mcq\Entities\ModelTest;
use Modules\Mcq\Entities\Question;

class UserLogController extends Controller
{
    protected $userLogModelObject;

    public function __construct()
    {
        $this->userLogModelObject = new UserLog();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function userLog(UserLogsDataTable $dataTable)
    {
        $data = ['title' => __('User Logs')];
        return $dataTable->render('useraccess::log', $data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function writerLog(WriterLogsDataTable $dataTable)
    {
        $data = ['title' => __('Writer Logs')];
        return $dataTable->render('useraccess::log', $data);
    }

    public function writerDetail(Request $request)
    {
        $userId    = $request->user_id;
        $startDate = $request->start_date;
        $endDate   = $request->end_date;

        if ($startDate != null) $startDate = date('Y-m-d', strtotime($startDate));
        if ($endDate != null) $endDate = date('Y-m-d', strtotime($endDate));

        $data = [
            'users' => User::whereHas("roles", function ($query) {
                $query->where("name", "Writer");
            })->oldest('name')->get(['id', 'name']),
            'userId' => $userId,
            'endDate' => $endDate,
            'startDate' => $startDate,
        ];


        if ($userId != null) {

            $data['examCount'] = (new Exam())->getWriterExamCount($userId, $startDate, $endDate);
            $data['examQuestionCount'] = (new ExamQuestion())->getWriterExamQuestionCount($userId, $startDate, $endDate);
            $data['mcqCount'] = (new ModelTest())->getWriterMcqCount($userId, $startDate, $endDate);
            $data['questionCount'] = (new Question())->getWriterQuestionCount($userId, $startDate, $endDate);
            $data['subCategoryCount'] = (new SubCategory())->getWriterSubCategoryCount($userId, $startDate, $endDate);
            $data['childCategoryCount'] = (new ChildCategory())->getWriterChildCategoryCount($userId, $startDate, $endDate);

            return view('useraccess::writer-history', $data);
        }

        return view('useraccess::writer-history', $data);
    }

    /**
     * Remove the specified resource from storage.
     * @param UserLog $log
     * @return Renderable
     */
    public function destroy(UserLog $log)
    {
        $this->userLogModelObject->destroyUserLog($log);
        return back();
    }
}
