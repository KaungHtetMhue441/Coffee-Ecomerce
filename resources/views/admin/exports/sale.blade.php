<table>
    <thead>
        <tr>
            <th>Customer</th>
            <th>Payment
                Type</th>
            <th>Total Cost</th>
            <th>Admin</th>
            <th>created</th>
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
        </tr>
        @endforeach
    </tbody>
</table>