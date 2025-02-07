<x-client.app>
    <x-slot name="title">
        Tracking Order
    </x-slot>
    <x-slot name="style">
        <style>
            .step {
                position: relative;
                width: 20%;
                text-align: center;
            }

            .step .icon {
                padding: 5px;
                width: 60px;
                height: 60px;
                background: #ddd;
                border-radius: 50%;
                line-height: 50px;
                display: inline-block;
                font-size: 24px;
                color: white;
            }

            .step.active .icon {
                background: #28a745;
            }

            .step .title {
                margin-top: 8px;
                font-size: 14px;
                font-weight: bold;
            }

            .progress-bar {
                width: 100%;
                height: 6px;
                background: #ddd;
                position: absolute;
                top: 22px;
                left: 0;
                z-index: -1;
            }

            .progress-bar .filled {
                height: 6px;
                background: #28a745;
            }
        </style>
    </x-slot>
    <x-slot name="content">

        <div class="container mt-5">
            <h3 class="text-center mb-5 mt-2">Tracking Order ({{request()->order->id}})</h3>

            <div class="row justify-content-center my-3">
                <div class="card col-3 shadow">
                    <div class="card-body py-4">
                        <center>
                            {!!$qrCode!!}
                        </center>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between position-relative pb-5">

                @php
                $order = request()->order;
                $statuses = ['pending', 'accepted', 'cooking', 'delivered', 'arrived'];

                $icons = [
                'pending'=>"fas fa-lg fa-clock",
                'accepted'=>"fas fa-lg fa-check",
                'cooking'=>"fas fa-lg fa-utensils",
                'delivered'=>"fas fa-lg fa-truck",
                'arrived'=>"fas fa-lg fa-home"
                ];

                $orderStatusesArr = $orderStatuses->toArray();


                $currentStatusIndex = array_search(end($orderStatusesArr)['status'], $statuses);
                @endphp
                <div class="progress-bar">
                    <div class="filled" style="width:{{20 * $orderStatuses->count()}}%"></div> <!-- Adjust width dynamically -->
                </div>
                @foreach($statuses as $index => $status)

                <div class="step {{ $index <= $currentStatusIndex ? 'active' : '' }}">
                    <span class="icon"><i class="{{$icons[$status]}}"></i></span>
                    <div class="title">{{ucfirst($status)}}</div>
                    @if(count($orderStatusesArr) > $index)
                    <div><i class="fas fa-clock"></i>{{$orderStatuses[$index]->created_at->diffForHumans()}}</div>

                    @endif
                </div>
                @endforeach
            </div>
            <div class="card mt-5">
                <div class="card-header">
                    <h5>Your Order Details</h5>

                </div>
                <div class="card-body ">
                    <div class="row">
                        @foreach ($order->products as $product)
                        <x-client.order-menu :product="$product" :menuCount="4" />

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-client.app>