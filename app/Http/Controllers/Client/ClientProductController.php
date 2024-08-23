<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientProductController extends Controller
{
    public function product(Request $request)
    {
        $products = Product::query();
        if ($request['category_id']) {
            $products->where("category_id", $request['category_id']);
        }
        if ($request["product_name"]) {
            $products->where("name", "like", "%" . $request["product_name" . "%"]);
        }
        if ($request['price']) {
            $products->where("price", ">=", $request["price"])->orderby("price", "ASC");
        }

        $categories = Category::all();
        $products = $products->paginate(8)->appends($request->except("page"));
        return view("client.product", [
            "categories" => $categories,
            "products" => $products
        ]);
    }
    public function show(Product $product)
    {
        return view("client.product-detail", [
            "product" => $product
        ]);
    }
}
