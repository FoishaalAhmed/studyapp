<?php

namespace Modules\Job\Http\Controllers\User;

use Modules\Job\Entities\Job;
use Illuminate\Routing\Controller;

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
    public function index()
    {
        $type = request()->sort;
        
        $jobs = match ($type) {
            'expired' => Job::with('category:id,name')->where('end_date', '<', date('Y-m-d'))->latest()->paginate(30),
            'active' => Job::with('category:id,name')->where('end_date', '>', date('Y-m-d'))->latest()->paginate(30),
            default => Job::with('category:id,name')->latest()->paginate(30)
        };
        
        return view('job::user.index', compact('jobs', 'type'));
    }

    public function detail(Job $job, $title)
    {
        $data = [
            'job'  => $job->load('category:id,name'),
            'jobs' => Job::with('category:id,name')->where('id', '!=', $job->id)->latest()->take(5)->get()
        ];

        return view('job::user.detail', $data);
    }

    public function apply(Job $job) {

        return view('job::user.apply', compact('job'));

    }
}
