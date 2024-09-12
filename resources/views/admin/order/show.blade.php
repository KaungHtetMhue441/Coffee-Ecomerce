@php
$breadCrumbs = ['Order','Show'];
@endphp
<x-layouts.admin>
    <x-slot name="header">
        show
    </x-slot>

    <x-slot name="script">

        <x-slot name="content">
            <div class="page-header">
                <x-admin.breadcrumbs :items="$breadCrumbs">

                </x-admin.breadcrumbs>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Customer :
                                <span class="text-info">
                                    {{$order->user->name}}
                                </span>
                            </div>
                        </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        </div>
        <x-slot name="script">
            <script>
            </script>
        </x-slot>
</x-layouts.admin>