<?php

namespace Modules\Forum\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'photo', 'tags', 'description', 'view', 'status',
    ];

    public function comments()
    {
        return $this->hasMany(ForumComment::class);
    }

    public function comment()
    {
        return $this->hasOne(ForumComment::class)->latest();
    }

    public function replies()
    {
        return $this->hasManyThrough(ForumCommentReply::class, ForumComment::class);
    }

    public function replyUser()
    {
        return $this->hasManyThrough(User::class, ForumCommentReply::class);
    }

    public function commentUser()
    {
        return $this->hasManyThrough(User::class, ForumComment::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function storeForum(Object $request)
    {
        $photo = $request->file('photo');

        if ($photo) {

            $response = uploadImage($photo, 'public/images/forums/', 'forums', '465*260');

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $this->photo = 'public/images/forums/' . $response['file_name'];
        }

        $this->user_id = auth()->id();
        $this->title = $request->title;
        $this->tags = $request->tags;
        $this->description = $request->description;
        $this->save();
    }
}
