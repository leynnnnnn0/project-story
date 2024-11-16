<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Classification::where('Module', 'Category')->paginate(10);
        return Inertia::render('Category/Index', [
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'value' => 'required'
        ]);

        $classification = Classification::findOrFail($id);
        $classification->update([
            'SettingName' => $validated['name'],
            'Description' => $validated['description'],
            'Value' => $validated['value']
        ]);


        return to_route('categories.index');
    }
}
