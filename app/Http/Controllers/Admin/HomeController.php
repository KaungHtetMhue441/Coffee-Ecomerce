<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\User;
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
        $latestUsers = User::take(10)->orderBy("created_at", "DESC")->get();
        $latestSales = Sale::where("status", "complete")->take(10)->orderBy("created_at", "DESC")->get();
        // dd($saleCount);

        return view('admin.dashboard', [
            "userCount"=>$userCount,
            "categoryCount"=>$categoryCount,
            "productCount"=>$productCount,
            "saleCount"=>$saleCount,
            "latestUsers"=>$latestUsers,
            "latestSales"=>$latestSales
        ]);
    }
}
