<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $transaction = Transaction::with(["order", "sale"])->paginate(10);
        return view("admin.reports.budget", ["transactions" =>
        $transaction]);
    }
}
