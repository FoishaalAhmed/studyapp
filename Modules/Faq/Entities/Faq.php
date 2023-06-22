<?php

namespace Modules\Faq\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question', 'answer',
    ];

    public static $validateRule = [
        'question' => ['required', 'string', 'max:255'],
        'answer' => ['required', 'string'],
    ];

    public function storeFaq(Object $request)
    {
        $this->question = $request->question;
        $this->answer = $request->answer;
        $storeFaq = $this->save();

        $storeFaq
            ? session()->flash('success', 'New FAQ Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateFaq(Object $request)
    {
        $faq = $this::findOrFail($request->id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $updateFaq = $faq->save();

        $updateFaq
            ? session()->flash('success', 'FAQ Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyFaq(Object $faq)
    {
        $destroyFaq = $faq->delete();

        $destroyFaq
            ? session()->flash('success', 'FAQ Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
