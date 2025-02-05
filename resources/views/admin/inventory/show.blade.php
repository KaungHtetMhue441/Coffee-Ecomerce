@php
$breadCrumbs = ['Inventory', 'Details'];
@endphp
<x-layouts.admin>
    <x-slot name="header">
        Inventory Item Details
    </x-slot>

    <x-slot name="content">
        <div class="page-header">
            <x-admin.breadcrumbs :items="$breadCrumbs"></x-admin.breadcrumbs>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="item_name">Item Name</label>
                        <input type="text" class="form-control" id="item_name" name="item_name" value="{{ $item->item_name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $item->quantity }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" value="{{ $item->quantity > 0 ? 'In Stock' : 'Out of Stock' }}" readonly>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('admin.inventory.index') }}" class="btn btn-secondary">Back to Inventory</a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts.admin>