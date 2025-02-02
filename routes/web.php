<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MostBuyProductsController;
use App\Http\Controllers\Client\OrderTrackingController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\Report\ReportController;

Route::get('/', function () {
    return view('client.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', action: [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/order-tracking/{order}', [OrderTrackingController::class, 'show'])->name('order.tracking');

Route::middleware('auth:admin')->group(function () {
    Route::put('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.order.updateStatus');
    Route::get('/admin/reports/outcome', [ReportController::class, 'outcome'])->name('admin.report.outcome');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/client.php';
