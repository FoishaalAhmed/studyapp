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
        $data['user_id']    = $user_id    = $request->user_id;
        $data['start_date'] = $start_date = $request->start_date;
        $data['end_date']   = $end_date   = $request->end_date;

        if ($start_date != null) $start_date = date('Y-m-d', strtotime($start_date));
        if ($end_date != null) $end_date = date('Y-m-d', strtotime($end_date));

        $data['users'] = User::whereHas("roles", function ($q) {
            $q->where("name", "Writer");
        })->orderBy('name', 'asc')->get(['id', 'name']);

        if ($user_id != null) {

            $data['examCount'] = (new Exam())->getWriterExamCount($user_id, $start_date, $end_date);
            $data['examQuestionCount'] = (new ExamQuestion())->getWriterExamQuestionCount($user_id, $start_date, $end_date);
            $data['mcqCount'] = (new ModelTest())->getWriterMcqCount($user_id, $start_date, $end_date);
            $data['questionCount'] = (new Question())->getWriterQuestionCount($user_id, $start_date, $end_date);
            $data['subCategoryCount'] = (new SubCategory())->getWriterSubCategoryCount($user_id, $start_date, $end_date);
            $data['childCategoryCount'] = (new ChildCategory())->getWriterChildCategoryCount($user_id, $start_date, $end_date);

            return view('backend.admin.writerHistory', $data);
        }

        return view('backend.admin.writerHistory', $data);
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
