<?php

namespace Modules\Setting\Http\Controllers;

use Modules\Setting\Http\Requests\SettingRequest;
use Illuminate\Contracts\Support\Renderable;
use Modules\Setting\Entities\Setting;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $settingModelObject;

    public function __construct()
    {
        $this->settingModelObject = new Setting();
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('setting::setting');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SettingRequest $request)
    {
        if (! empty($request->ip_address) && $request->admin_security == 'On') {

            if (
                !in_array($request->ip(), ['::1', '127.0.0.1', 'localhost']) 
                && !in_array($request->ip(), array_column((json_decode($request->ip_address)), 'value'))
            ) {
                session()->flash('error', __('The ip addresses you have added doesn\'t belongs to you.'));
                return back();

            } elseif (
                in_array($request->ip(), ['::1', '127.0.0.1', 'localhost']) 
                && !in_array($request->ip(), array_column((json_decode($request->ip_address)), 'value'))
            ) {
                session()->flash('error', __('Please add a local ip address.'));
                return back();
            }
        }


        $response = $this->settingModelObject->storeSetting($request);
        session()->flash($response['alert'], $response['message']);
        return back();
    }
}
