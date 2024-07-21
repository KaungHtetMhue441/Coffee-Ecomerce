<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use PDF;
use Illuminate\Http\Request;

class BouncerPDFController extends Controller
{
    public function generatePDF(Sale $sale)
    {
        $sale->load("products");

        $data = [
            'title' => 'KAUNG Coffee shop',
            'date' => date('m/d/Y'),
            'totalPrice' => $sale->total_cost,
            'products' => $sale->products
        ];



        $pdf = PDF::loadView('admin.pdf.bouncer', $data);
        $customPaper = array(0, 0, 400, 800);
        $pdf->setPaper($customPaper);
        return $pdf->stream("bouncer.pdf");
    }
}
