<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryImpl;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = $this->productRepository->getAll($request);

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
        // dd();
        $request->validate([
            'name' => 'required|string|max:255',
            'en_name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:products,code',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|max:1000',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048', // validate file
        ]);

        $file = $request->file("file");
        $request['image'] = uploadFile($file, "/products/");
        $request['details'] = json_encode(json_decode($request->details, true)["details"]);
        $this->productRepository->create($request->all());

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
        $request->validate([
            'name' => 'required|string|max:255',
            'en_name' => 'required|string|max:255',
            'code' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|max:1000',
        ]);

        if ($request->hasFile("file")) {
            $file = $request->file("file");
            $request['image'] = uploadFile($file, "/products/");
            deleteFile("/products/", $product->image);
        }

        $this->productRepository->update($product, $request->all());

        return redirect()
            ->route('admin.product.index')
            ->with('success', "Product successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->productRepository->delete($product);
        deleteFile("/products", $product->image);

        return redirect()
            ->route("admin.product.index")
            ->with("success", "Product successfully deleted!");
    }
}
