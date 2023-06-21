<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ResourceSellsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buy;

class BuyController extends Controller
{
    protected $buyModelObject;

    public function __construct()
    {
        $this->buyModelObject = new Buy();
    }

    public function index(ResourceSellsDataTable $dataTable)
    {
        $type = (isset(request()->type)) ? request()->type : 'mcq' ;
        return $dataTable->render('backend.admin.buys.index', compact('type'));
        
    }

    public function status(Buy $buy, string $status)
    {
        $update = $buy->update(['status' => $status]);

        $update 
            ? session()->flash('success', 'Status Changed Successfully!') 
            : session()->flash('error', 'Something Went Wrong!') ;

        return back();
    }
}
