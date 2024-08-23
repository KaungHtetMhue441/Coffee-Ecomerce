<table>
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