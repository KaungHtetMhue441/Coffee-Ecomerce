@props([
"breadCrumbs"=>['Expense','Purchases']
])
<x-layouts.admin>
    <x-slot name="header">
        Purchases
    </x-slot>

    <x-slot name="script">

    </x-slot>
    <x-admin.breadcrumbs :items="$breadCrumbs">

    </x-admin.breadcrumbs>
    <x-slot name="content">
        <div class="container mt-5">
            <div class="d-flex justify-content-between mb-3">
                <h1>Purchases</h1>
                <!-- Button to trigger Create Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPurchaseModal">
                    Add Purchase
                </button>
            </div>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Supplier</th>
                        <th>Price</th>
                        <th>Purchased At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->id }}</td>
                        <td>{{ $purchase->supplier }}</td>
                        <td>{{ $purchase->price }}</td>
                        <td>{{ $purchase->purchased_at }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPurchaseModal{{ $purchase->id }}">
                                Edit
                            </button>
                            <!-- Delete Form -->
                            <form action="{{ route('admin.purchases.destroy', $purchase->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editPurchaseModal{{ $purchase->id }}" tabindex="-1" aria-labelledby="editPurchaseModalLabel{{ $purchase->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPurchaseModalLabel{{ $purchase->id }}">Edit Purchase</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.purchases.update', $purchase->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="supplier{{ $purchase->id }}" class="form-label">Supplier</label>
                                            <input type="text" class="form-control" id="supplier{{ $purchase->id }}" name="supplier" value="{{ $purchase->supplier }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name{{ $purchase->id }}" class="form-label">Item Name</label>
                                            <input type="text" class="form-control" id="name{{ $purchase->id }}" name="item_name" accept="" value="{{ $purchase->item_name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="quantity{{ $purchase->id }}" class="form-label">Quantity</label>
                                            <input type="number" step="0.01" class="form-control" id="quantity{{ $purchase->id }}" name="quantity" value="{{ $purchase->quantity }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price{{ $purchase->id }}" class="form-label">Price</label>
                                            <input type="number" step="0.01" class="form-control" id="price{{ $purchase->id }}" name="price" value="{{ $purchase->price }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="purchased_at{{ $purchase->id }}" class="form-label">Purchased At</label>
                                            <input type="datetime-local" class="form-control" id="purchased_at{{ $purchase->id }}" name="purchased_at" value="{{ $purchase->purchased_at ? $purchase->purchased_at->format('Y-m-d\TH:i') : '' }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Edit Modal -->
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No purchases found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Create Modal -->
        <div class="modal fade" id="createPurchaseModal" tabindex="-1" aria-labelledby="createPurchaseModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPurchaseModalLabel">Add Purchase</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.purchases.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="supplier" class="form-label">Supplier</label>
                                <input type="text" class="form-control" id="supplier" name="supplier" required>
                            </div>
                            <div class="mb-3">
                                <label for="item_name" class="form-label">Item Name</label>
                                <input type="text" class="form-control" id="item_name" name="item_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" step="0.01" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="purchased_at" class="form-label">Purchased At</label>
                                <input type="datetime-local" class="form-control" id="purchased_at" name="purchased_at">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Purchase</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Create Modal -->
    </x-slot>

</x-layouts.admin>