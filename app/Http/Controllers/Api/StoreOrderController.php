<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrderRequest;
use Illuminate\Http\Request;

class StoreOrderController extends Controller
{
    public function validateHeaderUpload(StoreOrderRequest $storeOrderRequest)
    {
        return response()->json(['success' => true]);
    }
}
