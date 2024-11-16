<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Classification::where('Module', 'Category')->paginate(10);
        return Inertia::render('Category/Index', [
            'categories' => $categories
        ]);
    }
}
