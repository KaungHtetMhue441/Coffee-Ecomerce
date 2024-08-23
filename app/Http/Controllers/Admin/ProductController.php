<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::query();

        if ($request['name']) {
            $products->where("name", 'like', '%' . $request['name'] . '%')
                ->orWhere("en_name", 'like', '%' . $request['name'] . '%');
        }

        if ($request['caategory']) {
            $products->whereHas("categories", function (Builder $query) use ($request) {
                $query->where("name", 'like', '%' . $request['name'] . '%');
            });
        }

        return view('admin.product.index', [
            "products" => $products->orderBy("id", "DESC")->paginate(10)->appends($request->except(['page']))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        return view("admin.product.create", [
            "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            "name" => "required|string|min:3"
        ]);
        $file = $request->file("file");
        $request['image'] = uploadFile($file, "/products/");

        Product::create($request->all());

        return redirect()
            ->route('admin.product.index')
            ->with('success', "Product successfully created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view("admin.product.edit", [
            "product" => $product,
            "categories" => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if ($request->hasFile("file")) {
            $file = $request->file("file");
            $request['image'] = uploadFile($file, "/products/");
            deleteFile("/products/", $product->image);
        }

        $product->update($request->all());
        return redirect()
            ->route('admin.product.index')
            ->with('success', "Product successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        deleteFile("/products", $product->image);
        return redirect()
            ->route("admin.product.index")
            ->with("success", "Product successfully created!");
    }
}
