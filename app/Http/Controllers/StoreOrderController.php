<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Vendor;

class StoreOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['branch', 'vendor'])->get();
        // 1 is status for Active
        $branches = Branch::select('id', 'Name')->where('status', 1)->get()->pluck('Name', 'id');
        $vendors = Vendor::select('id', 'Name')->where('status', 1)->get()->pluck('Name', 'id');
        return Inertia::render(
            'StoreOrder/Index',
            [
                'orders' => $orders,
                'branches' => $branches,
                'vendors' => $vendors
            ]
        );
    }

    public function create()
    {
        return Inertia::render('StoreOrder/Create');
    }
}
