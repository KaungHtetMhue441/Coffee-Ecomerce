<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\OrderStatusRepository;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    private $orderStatusRepository;

    public function __construct(OrderStatusRepository $orderStatusRepository)
    {
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function show(Order $order)
    {
        $orderStatuses = $this->orderStatusRepository->getByOrderId($order->id);

        return view('client.order_tracking', [
            'orderStatuses' => $orderStatuses,
        ]);
    }
}
