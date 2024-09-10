<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $sales = Sale::with("admin")->where("status", "complete");
        if ($request["customer_name"]) {
            $sales->where("customer", "like", "%" . $request["customer_name"] . "%");
        }

        if ($request["admin_name"]) {
            $sales->whereHas("admin", function ($query) use ($request) {
                $query->where("name", "like", "%" . $request['admin_name'] . "%");
            });
        }
        if ($request["payment_type"]) {
            $sales->where("payment_type", "like", "%" . $request["payment_type"] . "%");
        }
        if ($request["total_cost"]) {
            $sales->where("total_cost", ">=", $request['total_cost']);
        }
        if ($request["from"]) {
            $sales->whereDate("created_at", ">=", $request["from"]);
        }
        // if ($request["to"]) {
        //     $sales->whereDate("created_at", "<=", $request["to"]);
        // }

        $sales  = $sales->orderby("created_at", "DESC")->paginate(10)->appends($request->inputs);

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
            "admin_id" => auth()->guard("admin")->user()->id
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
        return redirect()->back();
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
        return redirect()->back();
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
        Transaction::create([
            "sale_id" => $sale->id,
            "total_amount" => $sale->total_cost,
            "payment_type" => $sale->payment_type,
            "application_type" => "sale"
        ]);
        $sale->load("products");
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

    public function drafts(Request $request)
    {
        $sales = Sale::with("admin")->where("status", "incomplete");
        if ($request["customer_name"]) {
            $sales->where("customer", $request["customer_name"]);
        }

        $sales  = $sales->orderby("created_at", "DESC")->paginate(10)->appends($request->except(['page']));

        return view("admin.sale.drafts", [
            "sales" => $sales
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
        $sale->delete();
        return redirect()->back()->with("success", "Sale Successfullly deleted!");
    }
}
