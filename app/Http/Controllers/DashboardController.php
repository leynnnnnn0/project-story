<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $result = Order::all();
        dd($result);
        return Inertia::render('Dashboard/Index');
    }
}
