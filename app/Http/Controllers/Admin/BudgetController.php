<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BudgetController extends Controller
{
    public function index(Request $request)
    {
        $transaction = Transaction::with(["order", "sale"])->get();
        return view("admin.budget.report");
    }
}
