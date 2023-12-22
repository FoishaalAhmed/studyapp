<?php

namespace Modules\Job\Http\Controllers\Admin;

use Modules\Job\Entities\JobUser;
use Illuminate\Routing\Controller;
use Modules\Job\DataTables\Admin\{ApplyDetailsDataTable, JobAppliesDataTable};

class JobUserController extends Controller
{
    protected $jobUserObject;

    public function __construct()
    {
        $this->jobUserObject = new JobUser();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(JobAppliesDataTable $dataTable)
    {
        return $dataTable->render('job::admin.apply');
    }

    /**
     * Show the specified resource.
     * @param int $jobId, $userId
     * @param int $userId
     * @return Renderable
     */
    public function show($jobId, $userId, ApplyDetailsDataTable $dataTable)
    {
        return $dataTable->render('job::admin.detail');
    }
}
