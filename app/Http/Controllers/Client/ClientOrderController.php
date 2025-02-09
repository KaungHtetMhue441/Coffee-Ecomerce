<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;

class ClientOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $type = null)
    {
        // if ($type == "")
        //     $type = null;

        $orders = Order::where("user_id", "=", auth()->user()->id);
        if ($type == null) {

            $orders->whereNotNull("status");
        } else {
            $orders->where("status", "like", "%" . $type . "%");
        }
        if ($request["from"]) {
            $orders->whereDate("order_date", ">=", $request["from"]);
        }
        if ($request["to"]) {
            $orders->whereDate("order_date", "<=", $request["to"]);
        }
        if ($request['id']) {
            $orders->where("id", "=", $request['id']);
        }
        $orders = $orders->paginate(8)->appends($request->all());
        return view("client.order.index", [
            "orders" => $orders,
            "type" => $type
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Log::info($request->all());
        $userId = $request->user_id;
        $products = json_decode($request->products, true);

        $total_amount = collect($products)->sum(function ($product) {
            return $product["price"] * $product["quantity"];
        });

        $order = Order::create([
            "user_id" => $userId,
            "total_amount" => $total_amount,
            "qr_code" => Str::uuid()
        ]);

        $order->products()->attach($products);
        return response()->json([
            "url" => route("order.payment", $order->id)
        ]);
    }

    public function choosePayment(Order $order)
    {
        return view("client.order.choose-payment", [
            "order" => $order
        ]);
    }

    public function chooseOrderDate(Request $request, Order $order)
    {
        $request->validate([
            "order_date" => "required|date"
        ]);

        // dd($request->order_date);

        $order->update([
            "order_date" => $request->order_date
        ]);
        return redirect()->back()->with("success", "Successfully Choosed order date");
    }

    public function otherPayment(Order $order)
    {
        return view("client.checkout.other-payment", [
            "order" => $order
        ]);
    }

    public function payBillWithOther(Request $request, Order $order)
    {
        $request->validate([
            "payment_type" => "required|string|min:3"
        ]);
        $file = $request->file("file");
        $request['image'] = uploadFile($file, "/orders/bill/");
        $request["status"] = "pending";

        OrderStatus::create([
            "order_id" => $order->id,
            "status" => "pending"
        ]);
        // $request["order_date"] = Carbon::now();
        $order->update($request->all());
        Transaction::create([
            "order_id" => $order->id,
            "payment_type" => $order->payment_type,
            "total_amount" => $order->total_amount,
            "user_id" => $order->user_id,
            "application_type" => "order"
        ]);
        return redirect()->route("profile.index")->with("success", "Successfully Order");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info($request->order);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load("products");
        return view("client.order.detail", [
            "order" => $order
        ]);
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
