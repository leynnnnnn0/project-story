<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        dd(DB::table('vendormasterfile')->get());
        return Inertia::render('Dashboard/Index');
    }
}
