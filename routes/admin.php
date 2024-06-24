

<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;



Route::middleware("guest:admin")->prefix("/admin")->name("admin.")->group(function(){
    Route::get('/register', [RegisteredAdminController::class, 'create'])
    ->name('register');

    Route::post('/register', [RegisteredAdminController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

});


Route::middleware("auth:admin")->prefix('/admin')->name("admin.")->group(function(){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name("dashboard");

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

    Route::controller(CategoryController::class)->prefix('/category')->name("category.")->group(function(){
        Route::get("/",'index')->name("index");
        Route::get("/create",'create')->name("create");
        Route::post("/store",'store')->name("store");
        Route::get("/show/{category}",'show')->name("show");
        Route::get("/edit/{category}",'edit')->name("edit");
        Route::put("/update/{category}",'update')->name("update");
        Route::get("/destroy/{category}",'destroy')->name("destroy");
    });
    
    Route::controller(ProductController::class)->prefix('/product')->name("product.")->group(function(){
        Route::get("/",'index')->name("index");
        Route::get("/create",'create')->name("create");
        Route::post("/store",'store')->name("store");
        Route::get("/show/{product}",'show')->name("show");
        Route::get("/edit/{product}",'edit')->name("edit");
        Route::put("/update/{product}",'update')->name("update");
        Route::get("/destroy/{product}",'destroy')->name("destroy");
    });
});
