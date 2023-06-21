<?php

namespace Modules\Job\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\Job\DataTables\JobsDataTable;
use Illuminate\Routing\Controller;
use Modules\Job\Entities\Job;
use Illuminate\Http\Request;

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
        return $dataTable->render('job::job');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('job::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('job::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('job::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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