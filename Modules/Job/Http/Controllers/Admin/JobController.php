<?php

namespace Modules\Job\Http\Controllers\Admin;

use Modules\Job\Entities\Job;
use Illuminate\Routing\Controller;
use Modules\Job\DataTables\Admin\JobsDataTable;

class JobController extends Controller
{
    protected $jobModelObject;

    public function __construct()
    {
        $this->jobModelObject = new Job();
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(JobsDataTable $dataTable)
    {
        return $dataTable->render('job::admin.job');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Job $job)
    {
        $this->jobModelObject->destroyJob($job);
        return back();
    }
}
