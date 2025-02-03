<?php

use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Client\ClientCartController;
use App\Http\Controllers\Client\ClientHomeController;
use App\Http\Controllers\Client\ClientOrderController;
use Laravel\Cashier\Http\Controllers\PaymentController;
use App\Http\Controllers\Client\ClientProductController;
use App\Http\Controllers\Stripe\StripePaymentController;

Route::name("client.")->group(function () {
    Route::get("/", [ClientHomeController::class, "index"])->name("index");
    Route::view("/about", 'client.about')->name("about");
    Route::view("contact", 'client.contact')->name("contact");
});

Route::controller(ClientProductController::class)->name("client.")->group(function () {
    Route::get("/product", "product")->name("product");
    Route::get("/show/{product}", "show")->name("product.show");
});



Route::controller(ClientCartController::class)->name("client.")->group(function () {
    Route::get("/get-products", "getProducts");
});

Route::controller(ClientOrderController::class)->prefix("order/")->name("order.")->group(function () {
    Route::get("choose-payment/{order?}", "choosePayment")->name("payment");
    Route::post("choose-date/{order}", 'chooseOrderDate')->name('chooseDate');
    Route::get("/payment-with-kbz-or-wave/{order}", "otherPayment")->name("payment.other");
    Route::post("/pay-bill-with-kbz-or-wave/{order}", "payBillWithOther")->name("pay-bill-other");
    Route::get("index/{type?}", "index")->name("index");
    Route::get("create", "create")->name("store");
    Route::get("show/{order}", "show")->name("show");
});
Route::view("/cart", "client.cart")->name("cart.index");


Route::controller(StripePaymentController::class)->prefix("order-stripe-checkout/")->name("order.stripe.checkout.")->group(function () {
    Route::get('form/{order}', 'showCheckoutForm')->name('form');
    Route::get('process/{order}', 'processCheckout')->name('process');
    Route::get('success', 'showSuccess')->name('success');
    Route::get('cancel', 'showCancel')->name('cancel');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', action: [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/setting', action: [ProfileController::class, 'setting'])->name('profile.setting');
    Route::get('/profile/inbox', action: [ProfileController::class, 'inbox'])->name(name: 'profile.inbox');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::post('stripe/webhook', [PaymentController::class, 'handleWebhook']);