<?php

namespace Modules\Job\Http\Controllers;

use Modules\Job\DataTables\ApplyDetailsDataTable;
use Modules\Job\DataTables\JobAppliesDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Job\Entities\JobUser;

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
        return $dataTable->render('job::apply');
    }

    /**
     * Show the specified resource.
     * @param int $jobId, $userId
     * @param int $userId
     * @return Renderable
     */
    public function show($jobId, $userId, ApplyDetailsDataTable $dataTable)
    {
        return $dataTable->render('job::detail');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
