<?php

namespace Modules\Forum\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ForumComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'forum_id', 'user_id', 'comment', 'photo',
    ];

    public function replies()
    {
        return $this->hasMany(ForumCommentReply::class, 'forum_comment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function storeComment(Object $request)
    {
        $photo = $request->file('photo');

        if ($photo) {

            $response = uploadImage($photo, 'public/images/forum-comments/', 'comments', '465*260');

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $this->photo = 'public/images/forum-comments/' . $response['file_name'];
        }

        $this->forum_id = $request->forum_id;
        $this->user_id = auth()->id();
        $this->comment = $request->comment;
        $this->save();
    }
}
