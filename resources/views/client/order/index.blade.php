<x-client.app>
    <x-slot name="title">
        Menus
    </x-slot>
    <x-slot name="content">
        <div class="row mt-3 pt-3 rounded shadow justify-content-start" style="background-color: white;">
            <h4 class="text-center text_primary">Order List</h4>
        </div>

        <div class="row mt-3 px-0">
            <div class="col-3 ps-0">
                <div class="card  shadow">
                    <div class="card-body bg_primary rounded">
                        <div class="d-flex align-items-start">
                            <div class="nav flex-column nav-pills me-3 w-100" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a style="text-decoration: none;" class="text-white w-100 text-start text_white" href="{{route("order.index","")}}">Drafts Orders</a>
                                <hr>
                                <a style="text-decoration: none;" class="text-white w-100 text-start text_white" href="{{route("order.index","pending")}}">Pending Orders</a>
                                <hr>
                                <a style="text-decoration: none;" class="text-white  w-100 text-start text_white" href="{{route("order.index","paid")}}">Paid Order Orders</a>
                                <hr>
                                <a style="text-decoration: none;" class="text-white  w-100 text-start text_white" href="{{route("order.index","completed")}}">Completed Orders</a>
                                <hr>
                                <a style="text-decoration: none;" class="text-white  w-100 text-start text_white" href="{{route("order.index","rejected")}}">Rejected Orders</a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9 shadow bg-white rounded">
                <table class="table table-hover table-stripe table-bordered-top border-black">
                    <thead>
                        <th>No</th>
                        <th>Produut amount</th>
                        <th>Total Amount</th>
                        <th>Payment Type</th>
                        <th>Status</th>
                        <th>Ordered date</th>
                        <th></th>

                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <td>{{++$loop->index}}</td>
                            <td>{{$order->products->count()}}</td>
                            <td>{{$order->total_amount}}</td>
                            <td><a href="/storage/orders/bill/{{$order->image}}" style="text-decoration: none;"
                                    onclick="{{$order->payment_type=="visa"?"return false;":""}}">
                                    {{$order->payment_type}}
                                </a></td>
                            <td>{{$order->status}}</td>
                            <td>{{$order->order_date?->format("Y-m-d")."(".$order->order_date?->diffForHumans().")"}}</td>
                            <td>
                                <a class="btn btn-outline-success btn-sm" href="{{route("order.show",$order->id)}}">
                                    <i class="fa fa-eye fa-md"></i>

                                </a>
                                @if($type==null)
                                <a class="btn btn-outline-success btn-sm" href="{{route("order.payment",$order->id)}}">
                                    Checkout

                                </a>
                                @elseif($type=="pending")

                                @else

                                <a class="btn btn-outline-success py-1 btn-sm" href="{{route("admin.order.vouncer",$order->id)}}">
                                    <i class="fa fa-money-bill fa-md"></i>
                                </a>
                                @endif
                            </td>

                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                <div class="row">
                    {{$orders->links()}}
                </div>
            </div>
        </div>
    </x-slot>
</x-client.app>