<?php

namespace Modules\Addon\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Addon\Entities\Addon;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $addons = Addon::all();
        return view('addon::index', compact('addons'));
    }

    /**
     * switchStatus
     *
     * @param  mixed $alias
     * @return void
     */
    public function switchStatus($alias)
    {
        $addon = Addon::find($alias);

        if (is_null($addon)) {
            session()->flash('error', __('Addon not found'));
            return back();
        }

        $addon->isEnabled() ? $addon->disable() : $addon->enable();
        session()->flash('success', __('Addon status updated.'));
        return back();
    }
}
