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
                        <form method="POST" action="{{route("order.pay-bill-other",$order->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Choose image</label>
                                <input class="form-control" type="file" name="file" id="formFile">
                            </div>
                            <div class="mb-3">
                                <select name="payment_type" class="form-select" id="">
                                    <option value="">Choose Payment Type</option>
                                    <option value="KBZ Pay">KBZ PAY</option>
                                    <option value="Wave Pay">Wave Pay</option>
                                </select>
                            </div>

                            <div class="mb-2">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                                <button class="btn btn-success float-end" type="submit">Order Products</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-client.app>