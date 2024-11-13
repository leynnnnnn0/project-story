<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class OrderApprovalController extends Controller
{
    public function index()
    {
        $orders = DB::table('transactionheader')->get();
        return Inertia::render('OrderApproval/Index', [
            'orders' => $orders
        ]);
    }
}
