<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ClientCartController extends Controller
{
    public function getProducts(Request $request)
    {
        $productsId = json_decode($request->products);
        $products = Product::whereIn("id", $productsId)->get();
        $products = $products->map(function ($product) {
            $product['image'] = 'http://localhost:8000' . $product->image_url;
            $product["desc"] = $product->short_desc;
            return $product;
        });
        return response()->json([
            "products" => $products
        ]);
    }
}
