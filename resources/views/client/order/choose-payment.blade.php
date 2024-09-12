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
                        @if($order->order_date==null)
                        <div class="col-12">
                            <form action="{{route('order.chooseDate',$order->id)}}" method="post">
                                @csrf
                                <input type="text" id="from_datepicker" class=" form-control mb-3" name="order_date" placeholder="Date From..">
                                @error('order_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-primary mb-3 w-100">Submit</button>
                            </form>
                        </div>
                        @endif
                        @if($order->order_date!=null)
                        <div class="col-12 mt-3 mb-3">
                            <h4 class="text-center text_primary">Choose Payment Method</h4>
                        </div>

                        <div class="mb-2 d-flex justify-content-center">
                            <a href="{{route("order.stripe.checkout.form",$order->id)}}" class="btn btn-outline-success float-end me-3" type="submit">
                                Pay With Card</a>

                            <a href="{{route("order.payment.other",$order->id)}}" class="btn btn-outline-info float-end" type="submit">Pay With KBZ Or Wave</a>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="script">
        <script type="text/javascript">
            flatpickr("#from_datepicker", {
                enableTime: false, // Set to true if you want to include time selection
                dateFormat: "Y-m-d",
                // Customize the date format as needed
                defaultDate: "{{request()->get('from')}}"
            });
        </script>
    </x-slot>
</x-client.app>