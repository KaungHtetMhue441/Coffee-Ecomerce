<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sales = Sale::with("admin")->where("status", "complete")->paginate(10)->appends($request->inputs);
        $totalPrice = $sales->reduce(function ($carry, $sale) {
            return $carry + $sale->total_cost;
        });
        return view(
            "admin.sale.index",
            [
                "sales" => $sales,
                "total_cost" => $totalPrice
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function new()
    {
        $sale = Sale::create([
            "admin_id" => auth()->user()->id
        ]);

        $category = Category::first();

        return redirect()->route("admin.sale.create", [
            "sale" => $sale->id,
            "category" => $category->id
        ]);
    }

    public function create(Sale $sale, Category $category)
    {
        $categories = Category::with("products")->get();
        $products = $category->products;
        $saleProducts = $sale->products;
        $totalPrice = $saleProducts->reduce(function ($carry, $product) {
            return $carry + ($product->price * $product->pivot->quantity);
        });

        return view("admin.sale.create", [
            "categories" => $categories,
            "products" => $products,
            "saleProducts" => $saleProducts,
            "total_price" => $totalPrice
        ]);
    }

    public function addProduct(Request $request, Sale $sale)
    {
        $product = Product::find($request->product_id);


        $saleProduct = $sale->products->where("id", $product->id);
        if ($saleProduct->count() > 0) {
            return redirect()->back()->with("error", "Already added!");
        }
        $sale->products()->attach([
            [
                "product_id" => $product->id,
                "quantity" => $request->quantity,
                "price" => $product->price
            ]
        ]);
        return redirect()->back()->with("success", "Product successfully added!");
    }

    public function updateProduct(Request $request, Sale $sale)
    {
        $product = Product::find($request->product_id);
        $products = $sale->products;
        $sale->products()->sync([
            $product->id => [
                "product_id" => $product->id,
                "quantity" => $request->quantity,
                "price" => $product->price
            ]
        ], false);
        return redirect()->back()->with("success", "Product successfully Updated!");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Sale $sale)
    {
        $sale->update([
            "customer" => $request->customer_name,
            "payment_type" => $request->payment_type,
            "total_cost" => $request->total_cost,
            "status" => "complete"
        ]);
        return redirect()->route("admin.sale.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return view("admin.sale.show", [
            "sale" => $sale->load("products")
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
