<table class="display table-bordered border-black table table-striped table-hover">
    <thead>
        <tr>
            <th>Customer</th>
            <th>Payment
                Type</th>
            <th>Total Amount</th>
            <th>Admin</th>
            <th>Status</th>
            <th>Order Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{$order->user->name}}</td>
            <td>
                {{$order->payment_type}}
            </td>
            <td>{{$order->total_amount}}</td>
            <td>{{$order->admin?->name}}</td>
            <td>
                <span>{{$order->status}}</span>
            </td>
            <td>{!!$order->order_date?->format("Y-m-d")."
                (".$order->order_date?->diffForHumans().")"!!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>