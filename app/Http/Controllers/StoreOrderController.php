<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class StoreOrderController extends Controller
{
    public function index()
    {
        return Inertia::render('StoreOrder/Index');
    }

    public function create()
    {
        return Inertia::render('StoreOrder/Create');
    }
}
