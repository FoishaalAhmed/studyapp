<?php

namespace Modules\Job\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB, Exception;

class JobUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id', 'user_id', 'title', 'document'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function storeJobUser(object $request)
    {
        try {
            DB::beginTransaction();
            $files = $request->file('document');

            foreach ($files as $key => $value) {
                if ($request->title[$key] == null) continue;
                $multipleUploadPath = 'public/images/jobDocuments/';
                $name                 = $value->getClientOriginalName();
                $ext                  = strtolower($value->extension());
                $multipleImageName  = date('YmdHis') . '_' . $name . '.' . $ext;
                $value->move($multipleUploadPath, $multipleImageName);

                $jobUser           = new self;
                $jobUser->document = $multipleUploadPath . $multipleImageName;
                $jobUser->title    = $request->title[$key];
                $jobUser->job_id   = $request->job_id;
                $jobUser->user_id  = auth()->id();
                $jobUser->save();
            }
            DB::commit();
            return __('Apply successful.');
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
