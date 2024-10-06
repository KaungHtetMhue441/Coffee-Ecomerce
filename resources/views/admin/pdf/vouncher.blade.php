<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laravel 11 Generate PDF Example - ItSolutionStuff.com</title>
    <style>
        body {
            font-family: 'Pyidaungsu', sans-serif;
        }

        table {
            width: 100%;
        }

        table,
        tr {
            border-bottom: 1px solid;
            border-color: black;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 10px 30px 10px 0px;
            text-align: left;
        }

        .text-left {
            text-align: left;
        }
    </style>
</head>

<body>
    <h3 style="text-align: center;">{{ $title }}</h3>
    <p>{{ $date }}</p>
    <p>Yaongon-Mandalay Road,Thandaung Stree conor,Taungoo</p>
    <p> Open Daily : 8:00AM To 8:00PM</p>
    @if($admin)
    <p class="text-left">CasherID.{{$admin->name}}</p>
    @endif
    <hr>
    <table class="table table-bordered">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        @forelse ($products as $product)
        <tr>
            <td>{{$product->name}}</td>
            <td>{{$product->pivot->quantity}}</td>
            <td>{{$product->pivot->price}} Kyats</td>
            <td>{{$product->pivot->quantity*$product->pivot->price}} Kyats</td>
        </tr>
        @empty

        @endforelse

        <tr>
            <td colspan="3">Total Price </td>
            <td>{{$totalPrice}} Kyats</td>
        </tr>

    </table>

    <center style="margin-top:20px; margin-bottom: 10px; text-align:center">"Items sold are not exchangeable"</center>
    <center style="text-align: center;">"Thank You"</center>

</body>

</html>