@php
$breadCrumbs = ['Sale','all'];
@endphp
<x-layouts.admin>
    <x-slot name="header">
        Sale report
    </x-slot>

    <x-slot name="script">

        <x-slot name="content">
            <div class="page-header">
                <x-admin.breadcrumbs :items="$breadCrumbs">

                </x-admin.breadcrumbs>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <!-- All Sales -->
                                <div class="inline-block float-end">
                                    <form action="{{route('admin.sale.index')}}" method="get">
                                        <div class="row pt-2">
                                            <div class="col-4 mb-3">
                                                <input type="text" value="{{request()->get('customer_name')}}" name="customer_name" class="form-control me-3" placeholder="Enter Customer Name">
                                                </input>
                                            </div>
                                            <div class="col-4">
                                                <input type="text" id="from_datepicker" class=" form-control" name="from" placeholder="Date From..">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" id="to_datepicker" class="form-control" name="to" placeholder="Date to..">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" value="{{request()->get('admin_name')}}" name="admin_name" class="form-control me-3" placeholder="Enter Admin Name"></input>
                                            </div>
                                            <div class="col-4">
                                                <input type="text" value="{{request()->get('category')}}" name="payment_type" class="form-control me-3" placeholder="Enter Payment Type.."></input>
                                            </div>
                                            <div class="col-4">
                                                <input type="text" value="{{request()->get('total_cost')}}" name="total_cost" class="form-control me-3" placeholder="Enter Total Cost"></input>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-3">Search</button>
                                                    <a class="btn btn-dark text-white me-3" href="{{route("admin.sale.index")}}">Reset</a>
                                                    <button href="{{route("admin.sale.index")}}" name="export" value="true" class="btn btn-success">Export</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display table-bordered border-black table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Payment
                                                Type</th>
                                            <th>Total Cost</th>
                                            <th>Admin</th>
                                            <th>created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $sale)
                                        <tr>
                                            <td>{{$sale->customer}}</td>
                                            <td>
                                                {{$sale->payment_type}}
                                            </td>
                                            <td>{{$sale->total_cost}}</td>
                                            <td>{{$sale->admin->name}}</td>
                                            <td>{{$sale->created_at->diffForHumans()}}</td>
                                            <td>
                                                <a href="{{route("admin.sale.show",$sale->id)}}" class=" btn btn-outline-info btn-sm me-3 py-1">
                                                    <i class="fa fa-eye fa-lg text-black"></i>
                                                </a>
                                                <a class="btn btn-outline-success py-1 btn-sm" href="{{route("admin.bouncer",$sale->id)}}">
                                                    <i class="fa fa-money-bill"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr rowspan="2">
                                            <th colspan="2">Total Selling Price</th>
                                            <th colspan="4" class="text-success">{{$total_cost}} Kyats</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row justidy-content-between">
                                {{$sales->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        </div>
        <x-slot name="script">
            <script>
                flatpickr("#from_datepicker", {
                    enableTime: false, // Set to true if you want to include time selection
                    dateFormat: "Y-m-d",
                    // Customize the date format as needed
                    defaultDate: "{{request()->get('from')}}"
                });
                flatpickr("#to_datepicker", {
                    enableTime: false, // Set to true if you want to include time selection
                    dateFormat: "Y-m-d", // Customize the date format as needed
                    defaultDate: "{{request()->get('to')}}"
                });
            </script>
        </x-slot>
</x-layouts.admin>