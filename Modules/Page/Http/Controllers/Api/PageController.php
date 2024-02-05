<?php

namespace Modules\Page\Http\Controllers\Api;

use Modules\Page\Entities\Page;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class PageController extends Controller
{
    public function terms()
    {
        $term = Page::where('slug', 'terms-condition')->first();

        if (is_null($term)) {
            $this->unprocessableResponse([], __('Terms and condition page does not exist.'));
        }

        return $this->successResponse($term);
    }

    public function privacy()
    {
        $privacy = Page::where('slug', 'privacy-policy')->first();
        if (is_null($privacy)) {
            $this->unprocessableResponse([], __('Privacy policy page does not exist.'));
        }

        return $this->successResponse($privacy);
    }

    public function contact()
    {
        $contact = Contact::first();
        if (is_null($contact)) {
            $this->unprocessableResponse([], __('This request could not be processed right now. Try again.'));
        }

        return $this->successResponse($contact);
    }
}
