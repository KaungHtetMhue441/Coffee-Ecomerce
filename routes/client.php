<?php

use Illuminate\Support\Facades\Route;

Route::name("client.")->group(function(){
    Route::view("/", "client.index")->name("index");
    Route::view("/about",'client.about')->name("about");
    Route::view("contact",'client.contact')->name("contact");
});
