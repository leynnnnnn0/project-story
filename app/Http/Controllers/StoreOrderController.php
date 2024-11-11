<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreOrderRequest;
use App\Imports\OrderListImport;
use App\Models\Branch;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Vendor;
use Maatwebsite\Excel\Facades\Excel;

class StoreOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['branch', 'vendor'])->get();
        $branches = Branch::options();
        $vendors = Vendor::options();

        return Inertia::render(
            'StoreOrder/Index',
            [
                'orders' => $orders,
                'branches' => $branches,
                'vendors' => $vendors
            ]
        );
    }

    public function create()
    {
        return Inertia::render('StoreOrder/Create');
    }

    public function validateHeaderUpload(StoreOrderRequest $storeOrderRequest)
    {
        $import = new OrderListImport();
        Excel::import($import, $storeOrderRequest->file('orders_list'));

        $importedCollection = $import->getImportedData();
        $branches = Branch::options();

        return Inertia::render('StoreOrder/Create', [
            'orders' => $importedCollection,
            'branches' => $branches
        ]);
    }
}
