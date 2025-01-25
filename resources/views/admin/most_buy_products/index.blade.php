@props([
"breadCrumbs"=>['Most Buy ','Products']
])
<x-layouts.admin>
    <x-slot name="header">
        Most Buy Products
    </x-slot>

    <x-slot name="script">
        <script>
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
        </script>
    </x-slot>
    <x-slot name="content">
        <div class="page-header">
            <x-admin.breadcrumbs :items="$breadCrumbs"></x-admin.breadcrumbs>
        </div>
        <div class="card">
            <div class="card-body">
                <h1>Most Buy Products</h1>
                <form method="GET" action="{{ route('admin.most_buy_products') }}">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="from_date">From Date:</label>
                            <input type="text" id="from_date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="to_date">To Date:</label>
                            <input type="text" id="to_date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="year">Year:</label>
                            <input type="number" id="year" name="year" class="form-control" value="{{ request('year', now()->year) }}">
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary mt-4 w-100">Filter</button>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.most_buy_products') }}" class="btn btn-warning mt-4 w-100">Reset</a>
                        </div>
                    </div>
                </form>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h2>Most Buy Products</h2>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Total Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mostBuyProducts as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->total_quantity }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $mostBuyProducts->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </x-slot>
</x-layouts.admin>