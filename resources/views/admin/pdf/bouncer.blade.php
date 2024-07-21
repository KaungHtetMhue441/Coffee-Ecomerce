<!DOCTYPE html>
<html>

<head>
    <title>Laravel 11 Generate PDF Example - ItSolutionStuff.com</title>
    <style>
        body {
            font-family: 'Pyidaungsu' !important;
            font-weight: normal;
            font-style: normal;
        }

        table {
            width: 100%;
        }

        table,
        tr {
            border-bottom: 1px solid black;
            border-collapse: collapse;
            /* text-align: left; */
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
    <p class="text-left">CasherID.{{auth()->guard("admin")->user()->name}}</p>
    <hr>
    <table class="table table-bordered">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        @forelse ($products as $product)
        <tr class="text-left">
            <td>{{$product->en_name}}</td>
            <td>{{$product->pivot->quantity}}</td>
            <td>{{$product->pivot->price}} Kyats</td>
            <td>{{$product->pivot->quantity*$product->pivot->price}} Kyats</td>
        </tr>
        @empty

        @endforelse

        <tr>
            <td colspan="3">Total Price </td>
            <td style="font-family: Pyidaungsu;">{{$totalPrice}} Kyats</td>
        </tr>

    </table>

    <center style="margin-top:20px;">"Items sold are not exchangeable"</center>
    <center>"Thank You"</center>

</body>

</html>