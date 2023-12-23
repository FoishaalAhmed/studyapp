<?php

namespace Modules\Job\Http\Controllers\Writer;

use Modules\Job\Entities\JobUser;
use Illuminate\Routing\Controller;
use Modules\Job\DataTables\Writer\{ApplyDetailsDataTable, JobAppliesDataTable};

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
        return $dataTable->render('job::writer.job-users.apply');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     */
    public function show(ApplyDetailsDataTable $dataTable)
    {
        return $dataTable->render('job::writer.job-users.detail');
    }
}
