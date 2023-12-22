<?php

namespace Modules\Job\Http\Controllers\Writer;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Job\Http\Requests\JobRequest;
use Modules\Job\Entities\{Job, JobCategory};
use Modules\Job\DataTables\Writer\JobsDataTable;

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
        return $dataTable->render('job::writer.jobs.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data = [
            'categories' => JobCategory::oldest('name')->get(['id', 'name'])
        ];
        return view('job::writer.jobs.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        $this->jobModelObject->storeJob($request);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param Job $job
     * \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        $data = [
            'job' => $job->load('links:id,job_id,link'),
            'categories' => JobCategory::oldest('name')->get(['id', 'name'])
        ];

        return view('job::writer.jobs.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Job $job
     * \Illuminate\Http\Response
     */
    public function update(JobRequest $request, Job $job)
    {
        $this->jobModelObject->updateJob($request, $job);
        return redirect()->route('writer.jobs.index');
    }
}
