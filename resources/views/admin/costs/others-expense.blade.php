@props([
"breadCrumbs"=>['Expense','Others']
])
<x-layouts.admin>
    <x-slot name="header">
        Others Expense
    </x-slot>

    <x-slot name="script">

    </x-slot>
    <x-admin.breadcrumbs :items="$breadCrumbs">

    </x-admin.breadcrumbs>
    <x-slot name="content">
        <div class="container mt-5">
            <div class="d-flex justify-content-between mb-3">
                <h1>Other Expenses</h1>
                <!-- Button to trigger Create Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createOtherCostModal">
                    Add Other Expense
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
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Incurred At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($otherExpenses as $otherExpense)
                    <tr>
                        <td>{{ $otherExpense->id }}</td>
                        <td>{{ $otherExpense->name}}</td>
                        <td>{{ $otherExpense->price }}</td>
                        <td>{{ $otherExpense->description }}</td>
                        <td>{{ $otherExpense->incurred_at }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editOtherCostModal{{ $otherExpense->id }}">
                                Edit
                            </button>
                            <!-- Delete Form -->
                            <form action="{{ route('admin.expenses.others.destroy', $otherExpense->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    @foreach($otherExpenses as $otherExpense)
                    <div class="modal fade" id="editOtherCostModal{{ $otherExpense->id }}" tabindex="-1" aria-labelledby="editOtherCostModalLabel{{ $otherExpense->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editOtherCostModalLabel{{ $otherExpense->id }}">Edit Other Expense</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.expenses.others.update', $otherExpense->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name{{ $otherExpense->id }}" class="form-label">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name{{ $otherExpense->id }}" name="name" value="{{ old('name', $otherExpense->name) }}" required>
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="price{{ $otherExpense->id }}" class="form-label">Price</label>
                                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price{{ $otherExpense->id }}" name="price" value="{{ old('price', $otherExpense->price) }}" required>
                                            @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="description{{ $otherExpense->id }}" class="form-label">Description</label>
                                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description{{ $otherExpense->id }}" name="description" value="{{ old('description', $otherExpense->description) }}" required>
                                            @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="incurred_at{{ $otherExpense->id }}" class="form-label">Incurred At</label>
                                            <input type="datetime-local" class="form-control @error('incurred_at') is-invalid @enderror" id="incurred_at{{ $otherExpense->id }}" name="incurred_at" value="{{ old('incurred_at', $otherExpense->incurred_at ? $otherExpense->incurred_at->format('Y-m-d\TH:i') : '') }}">
                                            @error('incurred_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
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
                    @endforeach

                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No other expenses found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Create Modal -->
        <div class="modal fade" id="createOtherCostModal" tabindex="-1" aria-labelledby="createOtherCostModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createOtherCostModalLabel">Add Other Expense</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.expenses.others.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" required>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="incurred_at" class="form-label">Incurred At</label>
                                <input type="datetime-local" class="form-control @error('incurred_at') is-invalid @enderror" id="incurred_at" name="incurred_at" value="{{ old('incurred_at') }}">
                                @error('incurred_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Expense</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Create Modal -->

    </x-slot>

</x-layouts.admin>