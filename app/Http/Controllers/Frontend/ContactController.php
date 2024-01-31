<?php

namespace App\Http\Controllers\Frontend;

use Modules\Faq\Entities\Faq;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function faq()
    {
        $faqs = Faq::oldest('question')->get()->toArray();
        return view('frontend.faq', compact('faqs'));
    }
}
