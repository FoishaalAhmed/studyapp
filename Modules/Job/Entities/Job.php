<?php

namespace Modules\Job\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_category_id', 'title', 'company', 'location', 'end_date', 'description', 'file',
    ];

    public static $validateRule = [
        'job_category_id' => ['numeric', 'required', 'min:1'],
        'title' => ['string', 'required', 'max:255'],
        'company' => ['string', 'nullable', 'max:255'],
        'location' => ['string', 'nullable', 'max:255'],
        'end_date' => ['date', 'required', 'after:yesterday'],
        'description' => ['string', 'nullable'],
        'file' => ['mimes: jpeg,jpg,png,gif,webp,pdf,doc,docx', 'max: 25000', 'nullable'],
    ];

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    public function links()
    {
        return $this->hasMany(JobLink::class);
    }

    public function storeJob(Object $request)
    {
        $photo = $request->file('file');

        if ($photo) {

            $response = uploadImage($photo, 'public/images/jobs/', 'jobs', '610*365');

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $this->file = 'public/images/jobs/' . $response['file_name'];
        }

        $this->job_category_id = $request->job_category_id;
        $this->title = $request->title;
        $this->company = $request->company;
        $this->salary = $request->salary;
        $this->location = $request->location;
        $this->end_date = date('Y-m-d', strtotime($request->end_date));
        $this->description = $request->description;
        $this->save();

        if ($request->links) {
            foreach ($request->links as $key => $value) {
                if ($value == null) continue;
                $data[] = [
                    'job_id' => $this->id,
                    'link' => $value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            if (isset($data)) JobLink::insert($data);
        }

        session()->flash('success', 'New Job Created Successfully!');
    }

    public function updateJob(Object $request, Object $job)
    {
        $photo = $request->file('file');

        if ($photo) {

            $response = uploadImage($photo, 'public/images/jobs/', 'jobs', '610*365', $job->file);

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $job->file = 'public/images/jobs/' . $response['file_name'];
        }

        $job->job_category_id = $request->job_category_id;
        $job->title = $request->title;
        $job->company = $request->company;
        $job->salary = $request->salary;
        $job->location = $request->location;
        $job->end_date = date('Y-m-d', strtotime($request->end_date));
        $job->description = $request->description;
        $job->save();

        if ($request->links) {
            JobLink::where('job_id', $job->id)->delete();
            foreach ($request->links as $key => $value) {
                $data[] = [
                    'job_id' => $job->id,
                    'link' => $value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            JobLink::insert($data);
        }

        session()->flash('success', 'Job Updated Successfully!');
    }

    public function destroyJob(Object $job)
    {
        if (file_exists($job->file)) unlink($job->file);

        JobLink::where('job_id', $job->id)->delete();
        $job->delete();

        session()->flash('success', 'Job Deleted Successfully!');
    }
}
