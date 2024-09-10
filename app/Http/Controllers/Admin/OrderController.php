<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $orders = Order::query();
        if ($request["type"]) {
            $orders->where("status", $request["type"]);
        }
        if ($request['username']) {
            $orders->whereHas("user", function ($query) use ($request) {
                $query->where("name", "like", "%" . $request['username'] . "%");
            });
        }

        $orders = $orders->orderby("order_date", "DESC")->paginate(10)->appends($request->all());
        $totalPrice = $orders->reduce(function ($carry, $order) {
            return $carry + $order->total_amount;
        });
        return view("admin.order.index", [
            "status" => $request["type"],
            "orders" => $orders,
            "total_amount" => $totalPrice
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function approve(Order $order)
    {
        $order->update([
            "admin_id" => auth()->guard("admin")->user()->id,
            "status" => OrderStatus::PAID
        ]);
        return redirect()->back()->with("success", "Successfullly Approved");
    }
    public function complete(Order $order)
    {
        $order->update([
            "admin_id" => auth()->guard("admin")->user()->id,
            "status" => OrderStatus::COMPLETED
        ]);
        return redirect()->back()->with("success", "Successfullly Completed");
    }

    public function getMostBuyCustomer()
    {

        $orders = Order::with('user')->join("users", 'orders.user_id', '=', 'users.id')
            ->groupBy("users.id")
            ->selectRaw("
        users.id as user_id,sum(orders.total_amount) as total")
            ->orderby("total")
            ->take(10)
            ->get();
        // dd($users);
        return view("admin.order.most-buy-customer", ["orders" => $orders]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load("products");
        return view(
            "admin.order.show",
            [
                "order" => $order
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
