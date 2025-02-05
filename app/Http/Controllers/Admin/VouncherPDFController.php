<?php

namespace App\Http\Controllers\Admin;

use App\PDF\PDF;
use App\Models\Sale;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VouncherPDFController extends Controller
{
    public function generatePDF(Sale $sale)
    {
        $sale->load("products");

        $data = [
            'title' => 'Coffee House',
            'admin' => $sale->admin,
            'date' => date('m/d/Y'),
            'totalPrice' => $sale->total_cost,
            'products' => $sale->products
        ];

        $mpdf = (new PDF())->getMpdf();

        $html = view('admin.pdf.vouncher', $data)->render();

        $mpdf->WriteHTML($html);

        return response($mpdf->Output(), 200, [
            "Content-Type" => "application/pdf"
        ]);
    }
    public function generateOrderPDF(Order $order)
    {
        $order->load("products");
        $order->admin;

        $data = [
            'title' => 'Coffee Shop',
            'date' => date('m/d/Y'),
            "admin" => $order->admin,
            'totalPrice' => $order->total_amount,
            'products' => $order->products
        ];

        $mpdf = (new PDF())->getMpdf();

        $html = view('admin.pdf.vouncher', $data)->render();

        $mpdf->WriteHTML($html);

        return response($mpdf->Output(), 200, [
            "Content-Type" => "application/pdf"
        ]);
    }
}
