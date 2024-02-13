<?php

namespace Modules\Job\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Job\Entities\{Job, JobCategory, JobUser};
use Modules\Job\Http\Requests\Api\JobApplyRequest;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with(['category:id,name'])->latest()->get(['id', 'job_category_id', 'title', 'location', 'company', 'end_date']);
        return $this->successResponse($jobs);
    }

    public function categories()
    {
        $categories = JobCategory::withCount('jobs')->oldest('name')->get();
        return $this->successResponse($categories);
    }

    public function categoryJobs($categoryId)
    {
        $jobs = Job::with(['category:id,name'])->where('job_category_id', $categoryId)->latest()->get(['id', 'job_category_id', 'title', 'location', 'company', 'end_date']);
        return $this->successResponse($jobs);
    }

    public function detail($id)
    {
        $job = Job::with(['links:id,job_id,link', 'category:id,name'])->find($id);

        if (is_null($job)) {
            $this->unprocessableResponse([], __('This job does not exist.'));
        }

        return $this->successResponse($job);
    }

    public function jobApply(JobApplyRequest $request)
    {
        $response = (new JobUser())->storeJobUser($request);
        return $this->successResponse($response);
    }
}
