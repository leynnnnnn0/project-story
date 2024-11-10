<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExcelTemplateController;
use App\Http\Controllers\StoreOrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/store-orders', [StoreOrderController::class, 'index'])->name('store-orders');
Route::get('/store-orders/create', [StoreOrderController::class, 'create'])->name('store-orders-create');

Route::controller(ExcelTemplateController::class)->name('excel.')->prefix('excel')->group(function () {
    Route::get('/gsi-bakery-template', 'gsiBakeryTemplate')->name('gsi-bakery-template');
    Route::get('/gsi-pr-template', 'gsiPrTemplate')->name('gsi-pr-template');
    Route::get('/pul-template', 'pulTemplate')->name('pul-template');
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
