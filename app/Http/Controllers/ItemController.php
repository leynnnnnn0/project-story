<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function index()
    {
        $items = Product::paginate(10);
        return Inertia::render('Item/Index', [
            'items' => $items
        ]);
    }
}
