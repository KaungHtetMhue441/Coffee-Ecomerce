<?php

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\Report\ReportController;
use App\Http\Controllers\Client\OrderTrackingController;
use App\Http\Controllers\Admin\MostBuyProductsController;


Route::get('/', function () {
    return view('client.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/order-tracking/{order}', [OrderTrackingController::class, 'show'])->name('order.tracking');

Route::middleware('auth:admin')->group(function () {
    Route::put('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.order.updateStatus');
    Route::get('/admin/reports/outcome', [ReportController::class, 'outcome'])->name('admin.report.outcome');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/client.php';
require __DIR__ . '/notifications.php';

Route::get("uuid", function () {
    return Str::uuid();
});

Route::view("delivery-man", "delivery.index");


Route::post('/confirm-delivery/{qr_code}', function ($qr_code) {
    // $qr_code = $request->qr_code;
    $order = Order::where('qr_code', $qr_code)->first();

    if ($order) {
        $order->status = 'delivered';
        $order->save();
        return response()->json(['message' => 'Order successfully delivered!']);
    }


    return response()->json(['message' => 'Invalid QR Code'], 404);
})->name("delivery.confirm");

Route::get("success", function () {
    return view("delivery.success");
});
