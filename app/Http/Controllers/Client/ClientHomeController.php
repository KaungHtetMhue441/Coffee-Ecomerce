<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientHomeController extends Controller
{
    public function index()
    {
        $products = Product::query();
        $latestProducts = $products->orderBy("created_at")->paginate(4);
        $upcompginProducts = $products->orderBy("created_at")->paginate(4);
        $trendingProducts = $products->orderBy("created_at")->paginate(4);

        return view("client.index", [
            "latestProducts" => $products->take(4)->get(),
            "upcommingProducts" => $products->take(4)->get(),
            "trendingProducts" => $products->take(4)->get(),
        ]);
    }
}
