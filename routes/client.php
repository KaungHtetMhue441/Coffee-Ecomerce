<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ClientProductController;
use App\Http\Controllers\Client\ClientHomeController;

Route::name("client.")->group(function () {
    Route::get("/", [ClientHomeController::class, "index"])->name("index");
    Route::view("/about", 'client.about')->name("about");
    Route::view("contact", 'client.contact')->name("contact");
});

Route::controller(ClientProductController::class)->name("client.")->group(function () {
    Route::get("/product", "product")->name("product");
});

