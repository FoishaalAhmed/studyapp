<?php

namespace App\Http\Controllers\Api;

use App\Models\Buy;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ResourceBuyRequest;

class BuyController extends Controller
{
    private $buyModelObject;

    public function __construct()
    {
        $this->buyModelObject = new Buy();
    }

    public function list($type = 'mcq')
    {
        $resources = $this->buyModelObject->getUserResourceBuy($type);
        return $this->successResponse($resources);
    }

    public function store(ResourceBuyRequest $request)
    {
        try {
            $this->buyModelObject->storeBuy($request);
            return $this->successResponse(__('Resource Buy Successful. Please Wait For Admin Approve!'));
        } catch (\Exception $exception) {
            return $this->unprocessableResponse([], $exception->getMessage());
        }
    }
}
