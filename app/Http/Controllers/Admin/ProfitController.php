<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Order;
use App\Models\Salary;
use App\Models\OtherExpense;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProfitController extends Controller
{
    public function analysis(Request $request){
        $from = $request->input('from');
        $to = $request->input('to');
        $month = $request->input('month');
        $year = $request->input('year', Carbon::now()->year);

        if ($from && $to) {
            $from = Carbon::parse($from)->startOfDay();
            $to = Carbon::parse($to)->endOfDay();
        } elseif ($month) {
            $from = Carbon::create($year, $month, 1)->startOfMonth();
            $to = Carbon::create($year, $month, 1)->endOfMonth();
        } else {
            $from = Carbon::now()->startOfMonth();
            $to = Carbon::now()->endOfMonth();
        }

        $totalSalesAmount = Sale::whereBetween('sale_date', [$from, $to])->sum('amount');
        $totalOrdersAmount = Order::whereBetween('order_date', [$from, $to])->sum('amount');
        $totalSalariesAmount = Salary::whereBetween('incurent_at', [$from, $to])->sum('amount');
        $totalPurchasesAmount = Purchase::whereBetween('purchase_at', [$from, $to])->sum('amount');
        $totalOtherExpense = OtherExpense::whereBetween('incurent_at', [$from, $to])->sum('amount');

        $totalProfit = ($totalSalesAmount + $totalOrdersAmount) - ($totalSalariesAmount + $totalPurchasesAmount + $totalOtherExpense);

        return view("admin.profit.analysis", compact('totalSalesAmount', 'totalOrdersAmount', 'totalSalariesAmount', 'totalPurchasesAmount', 'totalOtherExpense', 'totalProfit'));
    }
}
