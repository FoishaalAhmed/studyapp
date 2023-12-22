<?php

namespace Modules\Job\Entities;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_category_id', 'title', 'company', 'location', 'end_date', 'description', 'photo',
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
        try {

            DB::beginTransaction();

            $photo = $request->file('photo');

            if ($photo) {

                $response = uploadImage($photo, 'public/images/jobs/', 'jobs', '610*365');

                if (!$response['status']) {
                    session()->flash('error', $response['message']);
                    return;
                }

                $this->photo = 'public/images/jobs/' . $response['file_name'];
            }

            $this->job_category_id = $request->job_category_id;
            $this->title = $request->title;
            $this->company = $request->company;
            $this->salary = $request->salary;
            $this->location = $request->location;
            $this->end_date = date('Y-m-d', strtotime($request->end_date));
            $this->description = $request->description;
            $this->user_id = auth()->id();
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

            DB::commit();

            session()->flash('success', 'New Job Created Successfully!');
        } catch (\Exception $exception) {
            DB::rollBack();
            session()->flash('error', $exception->getMessage());
        }
    }

    public function updateJob(Object $request, Object $job)
    {
        try {

            DB::beginTransaction();

            $photo = $request->file('photo');

            if ($photo) {

                $response = uploadImage($photo, 'public/images/jobs/', 'jobs', '610*365', $job->photo);

                if (!$response['status']) {
                    session()->flash('error', $response['message']);
                    return;
                }

                $job->photo = 'public/images/jobs/' . $response['file_name'];
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
            DB::commit();
            session()->flash('success', 'Job Updated Successfully!');

        } catch (\Exception $exception) {
            DB::rollBack();
            session()->flash('error', $exception->getMessage());
        }
    }

    public function destroyJob(Object $job)
    {
        if (file_exists($job->photo)) unlink($job->photo);

        JobLink::where('job_id', $job->id)->delete();
        $job->delete();

        session()->flash('success', 'Job Deleted Successfully!');
    }
}
