<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Inertia\Inertia;

class OrderApprovalController extends Controller
{
    public function index()
    {
        $orders = Order::with(['branch', 'vendor'])->paginate(10);
        return Inertia::render('OrderApproval/Index', [
            'orders' => $orders
        ]);
    }
}
