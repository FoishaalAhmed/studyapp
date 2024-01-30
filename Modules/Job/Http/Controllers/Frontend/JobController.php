<?php

namespace Modules\Job\Http\Controllers\Frontend;

use Modules\Job\Entities\Job;
use Illuminate\Routing\Controller;

class JobController extends Controller
{
    public function index()
    {
        $category = request()->category;

        $data = [
            'jobs' => isset($category)
                        ? Job::latest()->where('job_category_id', $category)->paginate(16)
                        : Job::latest()->paginate(16)
        ];

        return request()->view == 'grid' ? view('job::frontend.grid', $data) : view('job::frontend.list', $data);
    }

    public function list()
    {
        $category = request()->category;
        $data = ['jobs' => Job::latest()->where('job_category_id', $category)->paginate(15)];

        return view('job::frontend.list', $data);
    }

    public function search()
    {
        $data = ['jobs' => Job::latest()->where('title', 'like', '%' . request()->search . '%')->paginate(15)];

        return request()->view == 'grid' ? view('job::frontend.grid', $data) : view('job::frontend.list', $data);
    }

    public function detail()
    {
        $id  = base64_decode(request()->job);
        $job = Job::with('category:id,name')->findOrFail($id);

        $data = [
            'job'  => $job,
            'jobs' => Job::where('job_category_id', $job->job_category_id)->where('id', '!=', $id)->latest()->take(6)->get()
        ];

        return view('job::frontend.detail', $data);
    }
}
