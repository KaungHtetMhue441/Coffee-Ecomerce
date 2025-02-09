@props([
"orders"=>[],
"type"=>null
])
<div class="row">

    <div class="card-body bg_primary rounded">
        <!-- <div class="d-flex align-items-start p-0"> -->
        <form action="{{ route('profile.index') }}" method="GET">
            <div class="row justify-content-end">
                <div class="col-3">
                    <select class="form-select" id="orderStatus">
                        <option value="{{ route('profile.index', '') }}">All Orders</option>
                        <option value="{{ route('profile.index', ['status' => 'pending']) }}" {{ request()['status']=="pending" ? 'selected' : '' }}>Pending Orders</option>
                        <option value="{{ route('profile.index', ['status' => 'accepted']) }}" {{ request()['status']=="accepted"  ? 'selected' : '' }}>Accepted Orders</option>
                        <option value="{{ route('profile.index', ['status' => 'cooking']) }}" {{ request()['status']=="cooking"  ? 'selected' : '' }}>Cooking Orders</option>


                        <option value="{{ route('profile.index', ['status' => 'delivered']) }}" {{ request()['status']=="delivered"  ? 'selected' : '' }}>Delivered Orders</option>
                        <option value="{{ route('profile.index', ['status' => 'arrived']) }}" {{ request()['status']=="arrived"  ? 'selected' : '' }}>Arrived Orders</option>
                        <option value="{{ route('profile.index', ['status' => 'rejected']) }}" {{ request()['status']=="arrived" ? 'selected' : '' }}>Rejected Orders</option>

                    </select>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" name="id" placeholder="Enter Order ID" value="{{ request('id') }}">
                </div>
                <div class="col-3">
                    <input type="text" id="from_datepicker" class="form-control" name="from" placeholder="Order Date From.." value="{{ request('from') }}">
                </div>
                <div class="col-3">
                    <input type="text" id="to_datepicker" class="form-control" name="to" placeholder="Order Date To.." value="{{ request('to') }}">
                </div>
                <div class="col-12 ">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn_primary mt-3 px-5 me-3">Search</button>
                        <a href="{{route("profile.index")}}" class="btn btn-secondary mt-3 px-5">Reset</a>
                    </div>
                </div>
            </div>
        </form>

        <!-- </div> -->

    </div>
    <div class="col-12 mt-3 rounded bordered p-0">
        <div class="border p-2">
            <table class="table table-hover table-stripe table-bordered-top border-black">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Order ID</th>
                        <th>Product Amount</th>
                        <th>Total Amount</th>
                        <th>Payment Type</th>
                        <th>Status</th>
                        <th>Ordered Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr>
                        <td>{{ ++$loop->index }}</td>
                        <td>{{$order->id}}</td>
                        <td>{{ $order->products->count() }}</td>
                        <td>{{ $order->total_amount }}</td>
                        <td>
                            <a href="/storage/orders/bill/{{ $order->image }}" style="text-decoration: none;" onclick="{{ $order->payment_type == 'visa' ? 'return false;' : '' }}">
                                {{ $order->payment_type }}
                            </a>
                        </td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->order_date?->format('Y-m-d') . ' (' . $order->order_date?->diffForHumans() . ')' }}</td>
                        <td>
                            <a class="btn btn-outline-success btn-sm" href="{{ route('order.show', $order->id) }}">
                                <i class="fa fa-eye fa-md"></i>
                            </a>
                            <a class="btn btn-outline-success btn-sm" href="{{ route('order.tracking', $order->id) }}">
                                <i class="fas fa-location-arrow"></i>
                            </a>
                            @if($type == null)
                            <a class="btn btn-outline-success btn-sm" href="{{ route('order.payment', $order->id) }}">
                                Order Now
                            </a>

                            @elseif($type == 'pending')
                            <!-- No additional button -->
                            @elseif($type == 'arrived')
                            <a class="btn btn-outline-success py-1 btn-sm" href="{{ route('admin.order.voucher', $order->id) }}">
                                <i class="fa fa-money-bill fa-md"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No orders found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="row mt-3">
            {{ $orders->links() }}
        </div>
    </div>
</div>