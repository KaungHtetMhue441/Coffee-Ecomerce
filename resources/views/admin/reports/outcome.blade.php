@php
$breadCrumbs = ['Final Transaction','Expenses'];
@endphp
<x-layouts.admin>
    <x-slot name="header">
        Final Expenses Report
    </x-slot>

    <x-slot name="script">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                flatpickr("#from_date", {
                    enableTime: false,
                    dateFormat: "Y-m-d",
                    defaultDate: "{{ request('from_date') }}"
                });
                flatpickr("#to_date", {
                    enableTime: false,
                    dateFormat: "Y-m-d",
                    defaultDate: "{{ request('to_date') }}"
                });
            });
        </script>
    </x-slot>

    <x-slot name="content">
        <div class="page-header">
            <x-admin.breadcrumbs :items="$breadCrumbs">
            </x-admin.breadcrumbs>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.reports.outcome') }}" method="GET" class="mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-end">
                                    <div class="col-md-3">
                                        <label for="from_date">From Date</label>
                                        <input type="text" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="to_date">To Date</label>
                                        <input type="text" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="report_type">Report Type</label>
                                        <select name="report_type" id="report_type" class="form-control">
                                            <option value="daily" {{ request('report_type') == 'daily' ? 'selected' : '' }}>Daily</option>
                                            <option value="weekly" {{ request('report_type') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                            <option value="monthly" {{ request('report_type') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn w-100  btn-primary mt-4">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card">
                        <div class="card-header">
                            <h5>Outcome Details</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groupedOutcomes as $date => $outcomes)
                                    @foreach ($outcomes as $outcome)
                                    <tr>
                                        <td>{{ $date }}</td>
                                        <td>{{ $outcome->type }}</td>
                                        <td>{{ $outcome->amount }}</td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    @foreach ($groupedTotals as $date => $total)
                                    <tr>
                                        <th colspan="2">Total for {{ $date }}</th>
                                        <th>{{ $total }}</th>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="2">Overall Total</th>
                                        <th>{{ $totalOutcome }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts.admin>