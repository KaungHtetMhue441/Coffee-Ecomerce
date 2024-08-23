@php

@endphp
<x-client.app>
    <x-slot name="title">
        Menus
    </x-slot>
    <x-slot name="content">
        <div class="row mt-3 pt-3 rounded shadow justify-content-start" style="background-color: white;">
            <h4 class="text-center text_primary">Order List</h4>
        </div>

        <div class="row mt-3 px-0">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-bordered border-black table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>QTY</th>
                                    <th>Total price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($order->products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>
                                        {{$product->price}}
                                    </td>
                                    <td>
                                        {{$product->pivot->quantity}}
                                    </td>
                                    <td>{{$product->pivot->price*$product->pivot->quantity}}</td>
                                </tr>
                                @empty

                                @endforelse
                            </tbody>
                            <tfoot>
                                <th colspan="3">
                                    Total Amount
                                </th>
                                <th>
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
                    <div class="row">
                        <div class="col-12 mt-3 mb-3">
                            <h4 class="text-center text_primary">Choose Payment Method</h4>
                        </div>

                        <div class="mb-2 d-flex justify-content-center">
                            <a href="{{route("order.stripe.checkout.form",$order->id)}}" class="btn btn-outline-success float-end me-3" type="submit">
                                Pay With Card</a>

                            <a href="{{route("order.payment.other",$order->id)}}" class="btn btn-outline-info float-end" type="submit">Pay With KBZ Or Wave</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-client.app>