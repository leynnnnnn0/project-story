<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function index()
    {
        $search = request('search');
        $query = Product::query();
        if ($search)
            $query->whereAny(['InventoryID', 'InventoryName'], 'like', "%$search%");
        $items = $query->paginate(10);

        return Inertia::render('Item/Index', [
            'items' => $items,
            'filters' => request()->only(['search'])
        ]);
    }
}
