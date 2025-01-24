@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Profit Analysis</h1>
    <form method="GET" action="{{ route('admin.profit.analysis') }}">
        <div class="row">
            <div class="col-md-4">
                <label for="from">From:</label>
                <input type="date" id="from" name="from" class="form-control" value="{{ request('from') }}">
            </div>
            <div class="col-md-4">
                <label for="to">To:</label>
                <input type="date" id="to" name="to" class="form-control" value="{{ request('to') }}">
            </div>
            <div class="col-md-4">
                <label for="month">Month:</label>
                <input type="number" id="month" name="month" class="form-control" min="1" max="12" value="{{ request('month') }}">
            </div>
            <div class="col-md-4">
                <label for="year">Year:</label>
                <input type="number" id="year" name="year" class="form-control" value="{{ request('year', now()->year) }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary mt-4">Filter</button>
            </div>
        </div>
    </form>
    <div class="row mt-4">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Total Sales Amount</th>
                        <th>Total Orders Amount</th>
                        <th>Total Salaries Amount</th>
                        <th>Total Purchases Amount</th>
                        <th>Total Other Expense</th>
                        <th>Total Profit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $totalSalesAmount }}</td>
                        <td>{{ $totalOrdersAmount }}</td>
                        <td>{{ $totalSalariesAmount }}</td>
                        <td>{{ $totalPurchasesAmount }}</td>
                        <td>{{ $totalOtherExpense }}</td>
                        <td>{{ $totalProfit }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <h3>Calculation Process:</h3>
            <p>Total Profit = (Total Sales Amount + Total Orders Amount) - (Total Salaries Amount + Total Purchases Amount + Total Other Expense)</p>
            <p>Total Profit = ({{ $totalSalesAmount }} + {{ $totalOrdersAmount }}) - ({{ $totalSalariesAmount }} + {{ $totalPurchasesAmount }} + {{ $totalOtherExpense }})</p>
        </div>
    </div>
</div>
@endsection
