<x-client.app>
    <x-slot name="style">
        <style>
            a {
                text-decoration: none;
            }

            .active {
                border-bottom: 2px solid white !important;
                color: gray !important;
            }

            .nav a {
                border-bottom: 2px solid transparent;
                transition: border-bottom 0.3s ease;
                /* Adjust the timing and easing as needed */
            }

            .nav a:hover {
                border-bottom: 2px solid white;
            }
        </style>
    </x-slot>
    <x-slot name="title">
        Menus
    </x-slot>
    <x-slot name="content">

        <div class="row mt-5 px-0">
            <div class="mt-2"></div>
            <div class="col-12  ps-0">
                <div class="card shadow">
                    <div class="card-body bg_primary rounded">
                        <!-- <div class="d-flex align-items-start p-0"> -->
                        <select class="form-select" id="orderStatus">
                            <option value="{{ route('order.index', '') }}" {{ request()->is('order/index') ? 'selected' : '' }}>Draft Orders</option>
                            <option value="{{ route('order.index', 'pending') }}" {{ request()->is('order/index/pending') ? 'selected' : '' }}>Pending Orders</option>
                            <option value="{{ route('order.index', 'paid') }}" {{ request()->is('order/index/paid') ? 'selected' : '' }}>Paid Orders</option>
                            <option value="{{ route('order.index', 'completed') }}" {{ request()->is('order/index/completed') ? 'selected' : '' }}>Completed Orders</option>
                            <option value="{{ route('order.index', 'rejected') }}" {{ request()->is('order/rejected') ? 'selected' : '' }}>Rejected Orders</option>
                        </select>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3 shadow bg-white rounded">
                <div class="row mt-3 pt-3 rounded shadow justify-content-start" style="background-color: white;">
                    <h4 class="text-center text_primary">Order List</h4>
                </div>
                <table class="table table-hover table-stripe table-bordered-top border-black">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product Amount</th>
                            <th>Total Amount</th>
                            <th>Payment Type</th>
                            <th>Status</th>
                            <th>Ordered Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <td>{{ ++$loop->index }}</td>
                            <td>{{ $order->products->count() }}</td>
                            <td>{{ $order->total_amount }}</td>
                            <td>
                                <a href="/storage/orders/bill/{{ $order->image }}" style="text-decoration: none;" onclick="{{ $order->payment_type == 'visa' ? 'return false;' : '' }}">
                                    {{ $order->payment_type }}
                                </a>
                            </td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->order_date?->format('Y-m-d') . ' (' . $order->order_date?->diffForHumans() . ')' }}</td>
                            <td>
                                <a class="btn btn-outline-success btn-sm" href="{{ route('order.show', $order->id) }}">
                                    <i class="fa fa-eye fa-md"></i>
                                </a>
                                <a class="btn btn-outline-success btn-sm" href="{{ route('order.tracking', $order->id) }}">
                                    <i class="fas fa-location-arrow"></i>
                                </a>
                                @if($type == null)
                                <a class="btn btn-outline-success btn-sm" href="{{ route('order.payment', $order->id) }}">
                                    Order Now
                                </a>

                                @elseif($type == 'pending')
                                <!-- No additional button -->
                                @elseif($type == 'completed')
                                <a class="btn btn-outline-success py-1 btn-sm" href="{{ route('admin.order.voucher', $order->id) }}">
                                    <i class="fa fa-money-bill fa-md"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No orders found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="row">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="script">
        <script>
            $(document).ready(function() {
                $('#orderStatus').on('change', function() {
                    window.location.href = $(this).val();
                });
            });
        </script>
    </x-slot>
</x-client.app>