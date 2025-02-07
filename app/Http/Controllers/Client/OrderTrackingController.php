<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\OrderStatusRepository;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        $qrCode = QrCode::size(200)->generate($order->qr_code);

        return view('client.order_tracking', [
            'orderStatuses' => $orderStatuses,
            "qrCode" => $qrCode
        ]);
    }
}
