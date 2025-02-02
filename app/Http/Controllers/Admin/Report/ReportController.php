<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\OtherExpense;
use App\Models\Purchase;
use App\Models\Salary;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class ReportController extends Controller
{
    public function income(Request $request): View
    {
        $transaction = Transaction::with(["order", "sale"])->paginate(10);
        return view("admin.reports.income", ["transactions" =>
        $transaction]);
    }

    public function outcome(Request $request): View
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $reportType = $request->input('report_type', 'daily');

        $salaries = Salary::query();
        $othersExpense = OtherExpense::query();
        $purchases = Purchase::query();

        if ($fromDate) {
            $salaries->whereDate('incurred_at', '>=', $fromDate);
            $othersExpense->whereDate('incurred_at', '>=', $fromDate);
            $purchases->whereDate('purchased_at', '>=', $fromDate);
        }

        if ($toDate) {
            $salaries->whereDate('incurred_at', '<=', $toDate);
            $othersExpense->whereDate('incurred_at', '<=', $toDate);
            $purchases->whereDate('purchased_at', '<=', $toDate);
        }

        $salaries = $salaries->get()->map(function ($item) {
            $item->type = 'Salary';
            return $item;
        });

        $othersExpense = $othersExpense->get()->map(function ($item) {
            $item->type = 'Other Expense';
            $item->amount = $item->price;
            return $item;
        });
        $purchases = $purchases->get()->map(function ($item) {
            $item->type = 'Purchase';
            $item->amount = $item->price;
            $item->incurred_at = $item->purchased_at;
            return $item;
        });

        $totalOutcome = $salaries->sum('amount') + $othersExpense->sum('amount') + $purchases->sum('amount');

        $outcomes = $salaries->concat($othersExpense)->concat($purchases);
        $groupedOutcomes = $outcomes->groupBy(function ($item) use ($reportType) {
            if ($reportType == 'daily') {
                return $item->incurred_at->format('Y-m-d');
            } elseif ($reportType == 'weekly') {
                return $item->incurred_at->startOfWeek()->format('Y-m-d') . ' - ' . $item->incurred_at->endOfWeek()->format('Y-m-d');
            } elseif ($reportType == 'monthly') {
                return $item->incurred_at->format('Y-m');
            }
        });

        $groupedTotals = $groupedOutcomes->map(function ($group) {
            return $group->sum('amount');
        });

        return view("admin.reports.outcome", [
            'outcomes' => $outcomes,
            'totalOutcome' => $totalOutcome,
            'groupedOutcomes' => $groupedOutcomes,
            'groupedTotals' => $groupedTotals,
            'reportType' => $reportType,
        ]);
    }
}
