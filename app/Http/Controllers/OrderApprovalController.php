<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderApprovalController extends Controller
{
    public function index()
    {
        return Inertia::render('OrderApproval/Index');
    }
}
