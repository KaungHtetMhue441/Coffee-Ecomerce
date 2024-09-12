@php

@endphp
<x-client.app>
    <x-slot name="title">
        Menus
    </x-slot>
    <x-slot name="content">
        <div class="row mt-3 pt-3 rounded shadow justify-content-start" style="background-color: white;">
            <h4 class="text-center text_primary">Order No : {{$order->id}}</h4>
        </div>

        <div class="row mt-3 px-0">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-bordered-top border-black table-stripe table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>QTY</th>
                                    <th>Total price</th>
                                    <th>Payment Type</th>
                                    <th>Order date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($order->products as $product)
                                <tr>
                                    <td>
                                        <a style="text-decoration: none;" href="{{route("client.product.show",$product->id)}}">{{$product->name}}</a>

                                    </td>
                                    <td>
                                        {{$product->price}}
                                    </td>
                                    <td>
                                        {{$product->pivot->quantity}}
                                    </td>
                                    <td>{{$product->pivot->price*$product->pivot->quantity}}</td>
                                    <td>{{$product->payment_type}}</td>
                                    <td>{{$product->order_date?->format("Y-m-d")}}</td>
                                </tr>
                                @empty

                                @endforelse
                            </tbody>
                            <tfoot>
                                <th colspan="3">
                                    Total Amount
                                </th>
                                <th colspan="3">
                                    {{
                                            $order->products->reduce(function($carry,$product)
                                            {
                                            return $carry+($product->pivot->price*$product->pivot->quantity);
                                            })
                                            }}
                                </th>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    Comment:
                </div>
                <div class="card-body">
                    <p>
                        {{$order->comment->description}}
                    </p>
                </div>
            </div>
        </div>
    </x-slot>
</x-client.app>