<?php

namespace Modules\Forum\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ForumCommentReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'forum_comment_id', 'user_id', 'reply', 'photo',
    ];

    public static $validateRule = [
        'forum_comment_id' => ['required', 'numeric'],
        'reply' => ['required', 'string'],
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function storeReply(Object $request)
    {
        $photo = $request->file('photo');

        if ($photo) {
            $photo_name        = time();
            $ext               = strtolower($photo->extension());
            $photo_full_name   = $photo_name . '.' . $ext;
            $photo_upload_path = 'public/images/forumComments/';
            $photo_url         = $photo_upload_path . $photo_full_name;
            $photo_success     = $photo->move($photo_upload_path, $photo_full_name);
            $this->photo       = $photo_url;
        }

        $this->forum_comment_id = $request->forum_comment_id;
        $this->user_id = auth()->id();
        $this->reply = $request->reply;
        $this->save();
    }
}
