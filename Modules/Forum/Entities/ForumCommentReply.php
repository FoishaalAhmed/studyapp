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
        return $this->belongsTo(User::class);
    }

    public function storeReply(Object $request)
    {
        $photo = $request->file('photo');

        if ($photo) {

            $response = uploadImage($photo, 'public/images/forum-reply/', 'reply', '465*260');

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $this->photo = 'public/images/forum-reply/' . $response['file_name'];
        }

        $this->forum_comment_id = $request->forum_comment_id;
        $this->user_id = auth()->id();
        $this->reply = $request->reply;
        $this->save();
    }
}
