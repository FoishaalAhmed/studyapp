<?php

namespace App\Http\Controllers\User;

use App\Models\Buy;
use Modules\Mcq\Entities\ModelMark;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.user.dashboard');
    }

    public function rank()
    {
        $ranks = ModelMark::with('user')->groupBy('user_id')->orderByRaw('SUM(right_answer) DESC')
        ->oldest('total_time')->take(100)->get();
        return view('backend.user.rank', compact('ranks'));
    }

    public function buy()
    {
        $type      = request()->type ? request()->type : 'mcq';

        $data = [
            'type' => $type,
            'resources' => (new Buy())->getUserResourceBuy($type),
        ];

        return view('backend.user.resource-buy', $data);
    }
}
