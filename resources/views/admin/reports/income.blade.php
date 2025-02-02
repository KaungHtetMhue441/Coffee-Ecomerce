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
                                    <form action="{{route('admin.reports.income')}}" method="get">
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
                                                    <a class="btn btn-dark text-white" href="{{route("admin.sale.index")}}">Reset</a>
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
                                            <th>App</th>
                                            <th>Customer</th>
                                            <th>PaymentType</th>
                                            <th>Total Cost</th>
                                            <!-- <th>Admin</th> -->
                                            <th>created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                        @if($transaction->application_type=="sale")

                                        <tr>
                                            <td>{{$transaction->application_type}}</td>
                                            <td>{{$transaction->sale->customer}}</td>
                                            <td>
                                                {{$transaction->sale->payment_type}}
                                            </td>
                                            <td>{{$transaction->sale->total_cost}}</td>
                                            <!-- <td>{{$transaction->sale->admin->name}}</td> -->
                                            <td>{{$transaction->sale->created_at->diffForHumans()}}</td>
                                            <td>
                                                <a href="{{route("admin.sale.show",$transaction->sale->id)}}" class=" btn btn-outline-info btn-sm  py-1">
                                                    <i class="fa fa-eye fa-lg text-black"></i>
                                                </a>
                                                <a class="btn btn-outline-success py-1 btn-sm" href="{{route("admin.bouncer",$transaction->sale->id)}}">
                                                    <i class="fa fa-money-bill"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @elseif($transaction->application_type=="order")
                                        <tr>
                                            <td>{{$transaction->application_type}}</td>
                                            <td>{{$transaction->order->user->name}}</td>
                                            <td>

                                                <a
                                                    @if($transaction->order->payment_type!="visa")
                                                    href="/storage/orders/bill/{{$transaction->order->image}}"
                                                    @endif
                                                    style="text-decoration: none;" >

                                                    {{$transaction->order->payment_type}}
                                                </a>
                                            </td>
                                            <td>{{$transaction->order->total_amount}} Kyats</td>
                                            <!-- <td>{{$transaction->order->admin?->name}}</td> -->
                                            <!-- <td>{{$transaction->order->status}}</td> -->
                                            <td style="width: 140px;">{!!$transaction->order->order_date?->format("Y-m-d")."
                                                <br>(".$transaction->order->order_date?->diffForHumans().")"!!}
                                            </td>
                                            <td style="width: 250px;">
                                                <a href="{{route("admin.order.show",$transaction->order->id)}}" class=" btn btn-outline-info btn-sm me-1 py-1">
                                                    <i class="fa fa-eye fa-lg text-black"></i>
                                                </a>
                                                <a class="btn btn-outline-success py-1 btn-sm" href="{{route("admin.order.voucher",$transaction->order->id)}}">
                                                    <i class="fa fa-money-bill"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endif

                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3">Total Amount</th>
                                            <th>{{ $transactions->sum(function($transaction) {
                                                return $transaction->application_type == 'sale' ? $transaction->sale->total_cost : $transaction->order->total_amount;
                                            }) }} Kyats</th>
                                            <th colspan="2"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row justidy-content-between">
                                {{$transactions->links()}}
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