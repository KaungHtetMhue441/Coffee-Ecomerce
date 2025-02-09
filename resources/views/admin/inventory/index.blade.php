@php
$breadCrumbs = ['Inventory', 'List'];
@endphp
<x-layouts.admin>
    <x-slot name="header">
        Inventory List
    </x-slot>

    <x-slot name="content">
        <div class="page-header">
            <x-admin.breadcrumbs :items="$breadCrumbs"></x-admin.breadcrumbs>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <form method="GET" action="{{ route('admin.inventory.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="from_date">From Date</label>
                                <input type="text" class="form-control datetimepicker" id="from_date" name="from_date" value="{{ old('from_date', request('from_date')) }}">
                            </div>
                            <div class="col-md-3">
                                <label for="to_date">To Date</label>
                                <input type="text" class="form-control datetimepicker" id="to_date" name="to_date" value="{{ old('to_date', request('to_date')) }}">
                            </div>
                            <div class="col-md-3">
                                <label for="sort_by">Sort By</label>
                                <select class="form-control" id="sort_by" name="sort_by">
                                    <option value="quantity" {{ old('sort_by', request('sort_by')) == 'quantity' ? 'selected' : '' }}>Quantity</option>
                                    <option value="date_added" {{ old('sort_by', request('sort_by')) == 'date_added' ? 'selected' : '' }}>Date Added</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="order">Order</label>
                                <select class="form-control" id="order" name="order">
                                    <option value="asc" {{ old('order', request('order')) == 'asc' ? 'selected' : '' }}>Ascending</option>
                                    <option value="desc" {{ old('order', request('order')) == 'desc' ? 'selected' : '' }}>Descending</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label for="item_name">Search Item Name</label>
                                <input type="text" class="form-control" id="item_name" name="item_name" value="{{ old('search', request('item_name')) }}">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end w-100">
                            <button type="submit" class="btn btn-primary me-3">Filter</button>
                            <a href="{{route("admin.inventory.index")}}" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Date Added</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{ $item->item_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>
                                    <span class="badge {{ $item->quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $item->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                    </span>
                                </td>
                                <td>{{ $item->created_at->format("y-m-d") }}</td>
                                <td>
                                    <a href="{{ route('admin.inventory.details', $item->id) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('admin.inventory.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuantityModal" data-id="{{ $item->id }}">
                                        Increase
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#decreaseQuantityModal" data-id="{{ $item->id }}">
                                        Decrease
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Add Quantity Modal -->
        <div class="modal fade" id="addQuantityModal" tabindex="-1" role="dialog" aria-labelledby="addQuantityModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.inventory.addQuantity') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addQuantityModalLabel">Add Quantity</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="item_id" id="item_id">
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="date_added">Increase Date</label>
                                <input type="text" class="form-control datetimepicker" id="date_added" name="date_added" value="{{ old('date_added', request('date_added', now()->startOfMonth()->toDateString())) }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Increase Quantity</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Decrease Quantity Modal -->
        <div class="modal fade" id="decreaseQuantityModal" tabindex="-1" role="dialog" aria-labelledby="decreaseQuantityModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.inventory.decreaseQuantity') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="decreaseQuantityModalLabel">Retrieve Quantity</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="item_id" id="item_id_decrease">
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity_decrease" name="quantity" required>
                                <div class="mt-3">
                                    <label for="date_retrieved">Retrieve Date</label>
                                    <input type="text" class="form-control datetimepicker" id="date_retrieved" name="date_retrieved" value="{{ old('date_retrieved', request('date_retrieved', now()->startOfMonth()->toDateString())) }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Decrease Quantity</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="script">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                flatpickr("#from_date", {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    defaultDate: "{{ request('from_date') }}"
                });
                flatpickr("#to_date", {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    defaultDate: "{{ request('to_date') }}"
                });
                flatpickr("#date_added", {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    defaultDate: "{{ request('date_added', now()->startOfMonth()->toDateString()) }}"
                });
                flatpickr("#date_retrieved", {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    defaultDate: "{{ request('date_retrieved', now()->endOfMonth()->toDateString()) }}"
                });
            });

            $('#addQuantityModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var itemId = button.data('id');
                var modal = $(this);
                modal.find('#item_id').val(itemId);
                console.log(itemId);
            });

            $('#decreaseQuantityModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var itemId = button.data('id');
                var modal = $(this);
                modal.find('#item_id_decrease').val(itemId);
            });
        </script>
    </x-slot>
</x-layouts.admin>