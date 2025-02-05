@php
$breadCrumbs = ['Inventory', 'Edit'];
@endphp
<x-layouts.admin>
    <x-slot name="header">
        Edit Inventory Item
    </x-slot>

    <x-slot name="content">
        <div class="page-header">
            <x-admin.breadcrumbs :items="$breadCrumbs"></x-admin.breadcrumbs>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <form action="{{ route('admin.inventory.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" id="item_name" name="item_name" value="{{ $item->item_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required>{{ $item->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts.admin>