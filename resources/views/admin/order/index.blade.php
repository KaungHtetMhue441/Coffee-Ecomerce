@php
$breadCrumbs = ['Order','Uncomplete Orders'];
$breadCrumbs[1] = Str::ucfirst(request()["type"])." Order";

@endphp
<x-layouts.admin>
    <x-slot name="header">
        {{Str::ucfirst(request()["type"])}} Orders
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
                                    <form action="{{route('admin.order.index',request()["type"])}}" method="get">
                                        <div class="row pt-2">
                                            <div class="col-4 mb-3">
                                                <input type="text" value="{{request()->get('customer_name')}}" name="customer_name" class="form-control me-3" placeholder="Enter Customer Name">
                                                </input>
                                            </div>
                                            <div class="col-4">
                                                <input type="text" id="from_datepicker" class=" form-control" name="from" placeholder="Order Date From..">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" id="to_datepicker" class="form-control" name="to" placeholder="Order Date to..">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" value="{{request()->get('admin_name')}}" name="admin_name" class="form-control me-3" placeholder="Enter Admin Name"></input>
                                            </div>
                                            <div class="col-4">
                                                <input type="text" value="{{request()->get('payment_type')}}" name="payment_type" class="form-control me-3" placeholder="Enter Payment Type.."></input>
                                            </div>
                                            <div class="col-4">
                                                <input type="number" value="{{request()->get('total_amount')}}" name="total_amount" class="form-control me-3" placeholder="Enter Total Amount"></input>
                                            </div>

                                            <div class="col-4">
                                                <select class="form-select form-control mt-3" name="sort_by" id="sort_by">
                                                    <option value="">Sort By</option>
                                                    <option value="total_amount">Total Amount</option>
                                                    <option value="pay_date">Pay Date</option>
                                                </select>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-3">Search</button>
                                                    <a class="btn btn-dark text-white me-3" href="{{route("admin.order.index",request()["type"])}}">Reset</a>
                                                    <button class=" btn btn-success" name="export" value="true">Export</button>
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
                                            <th>Total Amount</th>
                                            @if($status!="pending")
                                            <th>Admin</th>
                                            @endif
                                            <th>Status</th>
                                            <th>Order Date</th>
                                            <th>Pay Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>{{$order->user->name}}</td>
                                            <td>
                                                <a
                                                    @if($order->payment_type!="visa")
                                                    href="/storage/orders/bill/{{$order->image}}"
                                                    @endif
                                                    style="text-decoration: none;">
                                                    {{$order->payment_type}}
                                                </a>
                                            </td>
                                            <td>{{$order->total_amount}} Kyats</td>
                                            @if($status!="pending")
                                            <td>{{$order->admin?->name}}</td>

                                            @endif

                                            @php
                                            $btn = "badge ";
                                            if($order->status=="pending"){
                                            $btn .= "badge-warning";
                                            }elseif($order->status=="paid"){
                                            $btn .="badge-success";
                                            }else{
                                            $btn.="badge-infa";
                                            }
                                            @endphp
                                            <td style="width: 60px!important;">
                                                <span class="badge {{$btn}}">{{$order->status}}</span>
                                            </td>
                                            <td style="width: 150px;">{!!$order->order_date?->format("Y-m-d")."
                                                <br>(".$order->order_date?->diffForHumans().")"!!}
                                            </td>
                                            <td style="width: 140px;">{!!$order->transaction?->created_at->format("Y-m-d")."
                                                <br>(".$order->transaction?->created_at?->diffForHumans().")"!!}
                                            </td>
                                            <td style="width: 250px;">
                                                @if($status=="pending")

                                                <a href="{{route("admin.order.reject",$order->id)}}" class=" btn btn-danger me-1 px-1 py-1">
                                                    <!-- <i class="fa fa-eye fa-lg text-block"></i> -->
                                                    reject
                                                </a>
                                                <a class="btn btn-success px-1 py-1" href="{{route("admin.order.approve",$order->id)}}">
                                                    <!-- <i class="fa fa-money-bill"></i> -->
                                                    Paid
                                                </a>
                                                @endif
                                                @if($status=="paid")
                                                <a class="btn btn-outline-success px-1 py-1" href="{{route("admin.order.complete",$order->id)}}">
                                                    <!-- <i class="fa fa-money-bill"></i> -->
                                                    complete
                                                </a>
                                                @endif
                                                <a href="{{route("admin.order.show",$order->id)}}" class=" btn btn-info me-1 px-3 py-1">
                                                    <i class="fa fa-eye fa-lg text-black"></i>
                                                </a>
                                                <a class="btn btn-primary py-1 px-3 " href="{{route("admin.order.voucher",$order->id)}}">
                                                    <i class="fa fa-money-bill"></i>
                                                </a>
                                                <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST" class="mt-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="status" class="form-control">
                                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="accepted" {{ $order->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                                        <option value="cooking" {{ $order->status == 'cooking' ? 'selected' : '' }}>Cooking</option>
                                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                        <option value="arrived" {{ $order->status == 'arrived' ? 'selected' : '' }}>Arrived</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr rowspan="2">
                                            <th colspan="2">Total Selling Price</th>
                                            <th colspan="4" class="text-success">{{$total_amount}} Kyats</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row justidy-content-between">
                                {{$orders->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        </div>
        <x-slot name="script">
            <script>
                $("#sort_by").change(function() {
                    $(this).closest("form").submit();
                });

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