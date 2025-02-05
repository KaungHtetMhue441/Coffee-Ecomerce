@php
$breadCrumbs = ['Inventory', 'Create'];
@endphp
<x-layouts.admin>
    <x-slot name="header">
        Create Inventory Item
    </x-slot>

    <x-slot name="content">
        <div class="page-header">
            <x-admin.breadcrumbs :items="$breadCrumbs"></x-admin.breadcrumbs>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <form action="{{ route('admin.inventory.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="item_name">Item Name</label>
                                <input type="text" class="form-control" id="item_name" name="item_name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts.admin>