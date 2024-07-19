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
        $products->paginate(8);
        return view("client.product", [
            "categories" => $categories,
            "products" => $products->get()
        ]);
    }
}
