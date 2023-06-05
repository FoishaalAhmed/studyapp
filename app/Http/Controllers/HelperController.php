<?php

namespace App\Http\Controllers;

use Modules\Category\Entities\SubCategory;

class HelperController extends Controller
{
    public function getSubCategories()
    {
        $type = request()->type;
        $categories = SubCategory::where('type', $type)->get(['id', 'name']);
        echo json_encode($categories);
    }
}
