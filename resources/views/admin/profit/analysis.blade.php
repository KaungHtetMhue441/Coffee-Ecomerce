@props([
"breadCrumbs"=>['Profits','Analysis']
])
<x-layouts.admin>
    <x-slot name="header">
        Analysing Profits
    </x-slot>

    <x-slot name="script">

    </x-slot>
    <x-slot name="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h1>Profit Analysis</h1>
                    <form method="GET" action="{{ route('admin.profits') }}">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="from_month">From Month:</label>
                                <input type="number" id="from_month" name="from_month" class="form-control" min="1" max="12" value="{{ request('from_month', 1) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="to_month">To Month:</label>
                                <input type="number" id="to_month" name="to_month" class="form-control" min="1" max="12" value="{{ request('to_month', now()->month) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="year">Year:</label>
                                <input type="number" id="year" name="year" class="form-control" value="{{ request('year', now()->year) }}">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mt-4 w-100">Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="alert">
                                <h3>Total Sales Amount: <span class="ms-2">+{{ number_format($totalSalesAmount, 2) }}</span></h3>
                            </div>
                            <div class="alert ">
                                <h3>Total Orders Amount: <span class=" ms-2">+{{ number_format($totalOrdersAmount, 2) }}</span></h3>
                            </div>
                            <div class="alert">
                                <h3>Total Salaries Amount: <span class=" ms-2">-{{ number_format($totalSalariesAmount, 2) }}</span></h3>
                            </div>
                            <div class="alert ">
                                <h3>Total Purchases Amount: <span class=" ms-2">-{{ number_format($totalPurchasesAmount, 2) }}</span></h3>
                            </div>
                            <div class="alert ">
                                <h3>Total Other Expense: <span class="ms-2">-{{ number_format($totalOtherExpense, 2) }}</span></h3>
                            </div>
                            <div class="alert ">
                                <h3>Total Profit: <span class="ms-2">{{ number_format($totalProfit, 2) }}</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4 class="text-center">Calculation Formula For Profits</h4>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <p><span class="fs-5 fw-bold">Calculation Process :</span> Total Profit = ({{ number_format($totalSalesAmount, 2) }} + {{ number_format($totalOrdersAmount, 2) }}) - ({{ number_format($totalSalariesAmount, 2) }} + {{ number_format($totalPurchasesAmount, 2) }} + {{ number_format($totalOtherExpense, 2) }})</p>
                                <p>Total Profit = (Total Sales Amount + Total Orders Amount) - (Total Salaries Amount + Total Purchases Amount + Total Other Expense)</p>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4 class="text-center">Monthly Profit Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Total Sales Amount</th>
                                            <th>Total Orders Amount</th>
                                            <th>Total Salaries Amount</th>
                                            <th>Total Purchases Amount</th>
                                            <th>Total Other Expense</th>
                                            <th>Total Profit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($paginatedMonthlyProfits as $monthlyProfit)
                                        <tr>
                                            <td>{{ $monthlyProfit['month'] }}</td>
                                            <td>+{{ number_format($monthlyProfit['totalSalesAmount'], 2) }}</td>
                                            <td>+{{ number_format($monthlyProfit['totalOrdersAmount'], 2) }}</td>
                                            <td>-{{ number_format($monthlyProfit['totalSalariesAmount'], 2) }}</td>
                                            <td>-{{ number_format($monthlyProfit['totalPurchasesAmount'], 2) }}</td>
                                            <td>-{{ number_format($monthlyProfit['totalOtherExpense'], 2) }}</td>
                                            <td>{{ number_format($monthlyProfit['totalProfit'], 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $paginatedMonthlyProfits->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts.admin>