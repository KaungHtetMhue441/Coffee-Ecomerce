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
        $items = 9;
        if ($request["items"]) {
            $items = intval($request['items']);
        }

        $products = Product::query();
        $search = $request["search"];
        if ($request["search"]) {
            $products->where("name", "like", "%" . $request["search"] . "%")
                ->orWhereHas("category", function ($query) use ($search) {
                    $query->where("name", "like", "%" . $search . "%");
                })
                ->orWhere("price", "=", intval($search));
            // dd(intval($search));
        }
        if ($request['category_id']) {
            $products->where("category_id", "=", $request['category_id']);
        }
        if ($request['price']) {
            $products->where("price", ">=", $request["price"])->orderby("price", "ASC");
        }
        if ($request['sort_by'] == "most-price") {
            $products->orderBy("price", "DESC");
        }
        if ($request['sort_by'] == "least-price") {
            $products->orderBy("price", "ASC");
        }
        if ($request['sort_by'] == "most-order") {
            $products->withCount("orders")->orderBy("price", "ASC");
        }
        if ($request['sort_by'] == "least-order") {
            $products->withCount("orders")->orderBy("price", "DESC");
        }

        

        $categories = Category::all();
        $products = $products->paginate($items)->appends($request->except("page"));

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
