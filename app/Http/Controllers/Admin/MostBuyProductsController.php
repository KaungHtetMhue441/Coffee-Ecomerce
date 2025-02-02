<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;

class MostBuyProductsController extends Controller
{
    public function index(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $year = $request->input('year', Carbon::now()->year);
        $perPage = 12; // Number of items per page

        $query = Product::query();

        if ($fromDate && $toDate) {
            $query->select(['products.id', 'products.name', "products.code", DB::raw('SUM(order_product.quantity) + SUM(product_sale.quantity) as total_quantity')])
                ->leftJoin('order_product', 'products.id', '=', 'order_product.product_id')
                ->leftJoin('orders', 'orders.id', '=', 'order_product.order_id')
                ->leftJoin('product_sale', 'products.id', '=', 'product_sale.product_id')
                ->leftJoin('sales', 'sales.id', '=', 'product_sale.sale_id')
                ->whereBetween('orders.order_date', [$fromDate, $toDate])
                ->orWhereBetween('sales.created_at', [$fromDate, $toDate])
                ->groupBy(['products.id', 'products.name', "products.code"])
                ->orderBy('total_quantity', 'desc');
        } else {
            $query->select(['products.id', 'products.name', "products.code", DB::raw('SUM(order_product.quantity) + SUM(product_sale.quantity) as total_quantity')])
                ->leftJoin('order_product', 'products.id', '=', 'order_product.product_id')
                ->leftJoin('orders', 'orders.id', '=', 'order_product.order_id')
                ->leftJoin('product_sale', 'products.id', '=', 'product_sale.product_id')
                ->leftJoin('sales', 'sales.id', '=', 'product_sale.sale_id')
                ->whereYear('orders.order_date', $year)
                ->orWhereYear('sales.created_at', $year)
                ->groupBy(['products.id', 'products.name', "products.code"])
                ->orderBy('total_quantity', 'desc');
        }

        // dd($query->toSql());

        $mostBuyProducts = $query->paginate($perPage);
        $mostBuyProducts->appends($request->query());

        return view('admin.most_buy_products.index', compact('mostBuyProducts'));
    }
}
