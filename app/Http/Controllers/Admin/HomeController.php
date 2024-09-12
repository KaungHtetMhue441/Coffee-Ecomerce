<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $categoryCount = Category::count();
        $productCount = Product::count();
        $saleCount = Sale::where("status", "complete")->count();
        $orderCount = Order::where("status", "pending")->count();
        $orders = Order::where("status", "pending")->take(10)->get();
        $latestUsers = User::take(10)->orderBy("created_at", "DESC")->get();
        $latestSales = Sale::where("status", "complete")->take(10)->orderBy("created_at", "DESC")->get();
        // dd($saleCount);

        return view('admin.dashboard', [
            "userCount" => $userCount,
            "categoryCount" => $categoryCount,
            "productCount" => $productCount,
            "saleCount" => $saleCount,
            "latestUsers" => $latestUsers,
            "latestSales" => $latestSales,
            'orderCount' => $orderCount,
            "orders" => $orders
        ]);
    }
}
