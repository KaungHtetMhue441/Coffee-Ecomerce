<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $orders = Order::query()->with("transaction");
        if ($request["customer_name"]) {
            $orders->where("customer", "like", "%" . $request["customer_name"] . "%");
        }

        if ($request["admin_name"]) {
            $orders->whereHas("admin", function ($query) use ($request) {
                $query->where("name", "like", "%" . $request['admin_name'] . "%");
            });
        }
        if ($request["payment_type"]) {
            $orders->where("payment_type", "like", "%" . $request["payment_type"] . "%");
        }
        if ($request["total_amount"]) {
            $orders->where("total_amount", "=", $request['total_amount']);
        }
        if ($request["type"]) {
            $orders->where("status", $request["type"]);
        }
        if ($request["from"]) {
            $orders->whereDate("order_date", ">=", $request["from"]);
        }
        if ($request["to"]) {
            $orders->whereDate("order_date", "<=", $request["to"]);
        }
        if ($request['username']) {
            $orders->whereHas("user", function ($query) use ($request) {
                $query->where("name", "like", "%" . $request['username'] . "%");
            });
        }

        if ($request['sort_by']) {
            if ($request['sort_by'] == "pay_date")
                $orders->join('transactions', 'orders.id', '=', 'transactions.order_id')
                    ->orderBy('transactions.created_at', 'desc');
            elseif ($request['sort_by'] == "total_amount") {
                $orders->orderby("total_amount", "ASC");
            }
            $orders->select("orders.*");
        } else {
            $orders->orderby("order_date", direction: "ASC");
        }



        if ($request['export']) {
            $orders = $orders->get();
            return Excel::download(new OrdersExport($orders), "orderReport.xlsx");
        }

        $orders = $orders->paginate(10)->appends($request->all());

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

    public function showRejectPage(Order $order)
    {
        return view("admin.order.reject", [
            'order' => $order
        ]);
    }
    public function reject(Request $request, Order $order)
    {
        $request->validate([
            "description" => "required|string"
        ]);
        $order->update([
            "admin_id" => auth()->guard("admin")->user()->id,
            "status" => OrderStatus::REJECTED
        ]);
        $order->comment()->create([
            "description" => $request->description
        ]);
        return redirect()->route("admin.order.index", ["type" => "pending"])->with("success", "Successfullly Reject");
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
