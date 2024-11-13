<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::select("select id,SettingName as 'CategoryCode',Value as 'CategoryName',Description,
        case when isActive = 1 then 'Active' else 'Deactivate' end as 'Status'
        from settings where Module = 'Category' order by id desc;");

        return Inertia::render('Category/Index', [
            'categories' => $categories
        ]);
    }
}
