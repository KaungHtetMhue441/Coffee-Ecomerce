@props([
"orders"=>[],
"type"=>null
])
<div class="row">

    <div class="card-body bg_primary rounded">
        <!-- <div class="d-flex align-items-start p-0"> -->
        <div class="row justify-content-end">
            <div class="col-3">
                <select class="form-select" id="orderStatus">
                    <option value="{{ route('profile.index') }}" {{ request()['type']=="" ? 'selected' : '' }}>Draft Orders</option>
                    <option value="{{ route('profile.index', ) }}?type=pending" {{ request()['type']=="pending" ? 'selected' : '' }}>Pending Orders</option>
                    <option value="{{ route('profile.index') }}?type=paid" {{ request()['type']=="paid" ? 'selected' : '' }}>Paid Orders</option>
                    <option value="{{ route('profile.index') }}?type=completed" {{ request()['type']=="completed" ? 'selected' : '' }}>Completed Orders</option>
                    <option value="{{ route('profile.index') }}?type=rejected" {{ request()['type']=="rejected" ? 'selected' : '' }}>Rejected Orders</option>
                </select>
            </div>
            <div class="col-3">
                <input type="text" class="form-control" placeholder="Enter Order ID">
            </div>
            <div class="col-3">
                <input type="text" id="from_datepicker" class=" form-control" name="from" placeholder="Order Date From..">
            </div>
            <div class="col-3">
                <input type="text" id="to_datepicker" class="form-control" name="to" placeholder="Order Date to..">
            </div>
            <div class="col-2 float-right">
                <button type="submit" class="btn btn_primary mt-3 w-100">Search</button>
            </div>
        </div>
        <!-- </div> -->

    </div>
    <div class="col-12 mt-3 rounded bordered p-0">
        <div class="border p-2">
            <table class="table table-hover table-stripe table-bordered-top border-black">
                <thead>
                    <tr>
                        <th>No</th>
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
                            @elseif($type == 'completed')
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