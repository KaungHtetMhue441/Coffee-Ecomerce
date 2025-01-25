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
use Illuminate\Pagination\LengthAwarePaginator;

class ProfitController extends Controller
{
    public function analysis(Request $request)
    {
        $fromMonth = $request->input('from_month', 1);
        $toMonth = $request->input('to_month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $perPage = 12; // Number of items per page

        $totalSalesAmount = 0;
        $totalOrdersAmount = 0;
        $totalSalariesAmount = 0;
        $totalPurchasesAmount = 0;
        $totalOtherExpense = 0;
        $totalProfit = 0;

        $monthlyProfits = [];
        for ($m = $fromMonth; $m <= $toMonth; $m++) {
            $startOfMonth = Carbon::create($year, $m, 1)->startOfMonth();
            $endOfMonth = Carbon::create($year, $m, 1)->endOfMonth();

            if ($fromDate && $toDate) {
                $startOfMonth = Carbon::parse($fromDate)->startOfDay();
                $endOfMonth = Carbon::parse($toDate)->endOfDay();
            }

            $monthlySalesAmount = Sale::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total_cost');
            $monthlyOrdersAmount = Order::whereBetween('order_date', [$startOfMonth, $endOfMonth])->sum('total_amount');
            $monthlySalariesAmount = Salary::whereBetween('incurred_at', [$startOfMonth, $endOfMonth])->sum('amount');
            $monthlyPurchasesAmount = Purchase::whereBetween('purchased_at', [$startOfMonth, $endOfMonth])->sum('price');
            $monthlyOtherExpense = OtherExpense::whereBetween('incurred_at', [$startOfMonth, $endOfMonth])->sum('price');

            $monthlyProfit = ($monthlySalesAmount + $monthlyOrdersAmount) - ($monthlySalariesAmount + $monthlyPurchasesAmount + $monthlyOtherExpense);

            $totalSalesAmount += $monthlySalesAmount;
            $totalOrdersAmount += $monthlyOrdersAmount;
            $totalSalariesAmount += $monthlySalariesAmount;
            $totalPurchasesAmount += $monthlyPurchasesAmount;
            $totalOtherExpense += $monthlyOtherExpense;
            $totalProfit += $monthlyProfit;

            $monthlyProfits[] = [
                'month' => $startOfMonth->format('F'),
                'totalSalesAmount' => $monthlySalesAmount,
                'totalOrdersAmount' => $monthlyOrdersAmount,
                'totalSalariesAmount' => $monthlySalariesAmount,
                'totalPurchasesAmount' => $monthlyPurchasesAmount,
                'totalOtherExpense' => $monthlyOtherExpense,
                'totalProfit' => $monthlyProfit,
            ];
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($monthlyProfits, ($currentPage - 1) * $perPage, $perPage);
        $paginatedMonthlyProfits = new LengthAwarePaginator($currentItems, count($monthlyProfits), $perPage);
        $paginatedMonthlyProfits->setPath($request->url());
        $paginatedMonthlyProfits->appends($request->query());

        return view("admin.profit.analysis", compact('totalSalesAmount', 'totalOrdersAmount', 'totalSalariesAmount', 'totalPurchasesAmount', 'totalOtherExpense', 'totalProfit', 'paginatedMonthlyProfits'));
    }
}
