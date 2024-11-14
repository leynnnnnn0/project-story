<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExcelTemplateController;
use App\Http\Controllers\OrderApprovalController;
use App\Http\Controllers\StoreOrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware('auth')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


        Route::controller(ExcelTemplateController::class)
            ->name('excel.')
            ->prefix('excel')
            ->group(function () {

                Route::get('/gsi-bakery-template', 'gsiBakeryTemplate')
                    ->name('gsi-bakery-template');
                Route::get('/gsi-pr-template', 'gsiPrTemplate')
                    ->name('gsi-pr-template');
                Route::get('/pul-template', 'pulTemplate')
                    ->name('pul-template');
            });

        Route::controller(StoreOrderController::class)
            ->prefix('store-orders')
            ->name('store-orders.')
            ->group(function () {

                Route::get('/', 'index')
                    ->name('index');

                Route::get('/show/{id}', 'show')
                    ->name('show');

                Route::post('/orders-list', 'validateHeaderUpload')
                    ->name('orders-list');

                Route::get('/create', 'create')
                    ->name('store-orders-create');

                Route::post('/store-orders', 'getImportedOrders')
                    ->name('imported-file');
            });

        Route::controller(OrderApprovalController::class)->name('order-approval.')->group(function () {
            Route::get('/orders-approval', 'index')->name('index');
        });

        Route::controller(CategoryController::class)->name('category.')->group(function () {
            Route::get('/category-list', 'index')->name('index');
        });



        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::patch('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::delete('/profile', [ProfileController::class, 'destroy'])
            ->name('profile.destroy');
    });

require __DIR__ . '/auth.php';
