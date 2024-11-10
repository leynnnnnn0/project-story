<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Order;

class StoreOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['branch'])->get();
        return Inertia::render(
            'StoreOrder/Index',
            ['orders' => $orders]
        );
    }

    public function create()
    {
        return Inertia::render('StoreOrder/Create');
    }
}
