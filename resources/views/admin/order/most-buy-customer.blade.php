@php
$breadCrumbs = ['Order','most-buy-customer'];
@endphp
<x-layouts.admin>
    <x-slot name="header">
        Top 10 most buy customer
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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display table-bordered border-black table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Email</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                {{$order->user->name}}
                                            </td>
                                            <td>
                                                {{$order->user->email}}
                                            </td>
                                            <td>
                                                {{$order->total}} Kyats
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
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
                flatpickr("#from_datepicker", {
                    enableTime: false, // Set to true if you want to include time selection
                    dateFormat: "Y-m-d",
                    // Customize the date format as needed
                    defaultDate: "{{request()->get('from')}}"
                });
                flatpickr("#to_datepicker", {
                    enableTime: false, // Set to true if you want to include time selection
                    dateFormat: "Y-m-d", // Customize the date format as needed
                    defaultDate: "{{request()->get('to')}}"
                });
            </script>
        </x-slot>
</x-layouts.admin>