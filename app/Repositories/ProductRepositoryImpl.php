<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductRepositoryImpl implements ProductRepository
{
    public function getAll(Request $request): Builder
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

        return $products;
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data): bool
    {
        return $product->update($data);
    }

    public function delete(Product $product): bool
    {
        return $product->delete();
    }
}
