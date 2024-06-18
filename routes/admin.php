

<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware("auth")->prefix('/admin')->group(function(){
    Route::get('/dashboard', function () {
        return view('admin.index');
    });
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
    // redirect()->route("product.index")
});
