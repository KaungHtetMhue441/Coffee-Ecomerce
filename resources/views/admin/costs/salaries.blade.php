@props([
"breadCrumbs" => ['Expense', 'Salaries'],
])
<x-layouts.admin>
    <x-slot name="header">
        Salaries
    </x-slot>

    <x-slot name="script">
        <script>
            // Add any custom scripts if needed
        </script>
    </x-slot>

    <x-admin.breadcrumbs :items="$breadCrumbs"></x-admin.breadcrumbs>

    <x-slot name="content">
        <div class="container mt-5">
            <div class="d-flex justify-content-between mb-3">
                <h1>Salaries</h1>
                <!-- Button to trigger Create Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSalaryModal">
                    Add Salary
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
                        <th>Employee</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Paid At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($salaries as $salary)
                    <tr>
                        <td>{{ $salary->id }}</td>
                        <td>{{ $salary->employee->name ?? 'Unknown' }}</td>
                        <td>{{ $salary->amount }}</td>
                        <td>{{ $salary->description }}</td>
                        <td>{{ $salary->incurred_at ? $salary->incurred_at->format('Y-m-d H:i') : 'N/A' }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSalaryModal{{ $salary->id }}">
                                Edit
                            </button>
                            <!-- Delete Form -->
                            <form action="{{ route('admin.salaries.destroy', $salary->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editSalaryModal{{ $salary->id }}" tabindex="-1" aria-labelledby="editSalaryModalLabel{{ $salary->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editSalaryModalLabel{{ $salary->id }}">Edit Salary</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.salaries.update', $salary->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="employee_id{{ $salary->id }}" class="form-label">Employee</label>
                                            <select class="form-control" id="employee_id{{ $salary->id }}" name="employee_id" required>
                                                @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}" @if($employee->id == $salary->employee_id) selected @endif>
                                                    {{ $employee->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="amount{{ $salary->id }}" class="form-label">Amount</label>
                                            <input type="number" step="0.01" class="form-control" id="amount{{ $salary->id }}" name="amount" value="{{ $salary->amount }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description{{ $salary->id }}" class="form-label">Description</label>
                                            <input type="text" class="form-control" id="description{{ $salary->id }}" name="description" value="{{ $salary->description }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="paid_at{{ $salary->id }}" class="form-label">Paid At</label>
                                            <input type="datetime-local" class="form-control" id="paid_at{{ $salary->id }}" name="paid_at" value="{{ $salary->paid_at ? $salary->paid_at->format('Y-m-d\TH:i') : '' }}">
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
                        <td colspan="6" class="text-center">No salaries found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Create Modal -->
        <div class="modal fade" id="createSalaryModal" tabindex="-1" aria-labelledby="createSalaryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createSalaryModalLabel">Add Salary</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.salaries.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="employee_id" class="form-label">Employee</label>
                                <select class="form-control" id="employee_id" name="employee_id" required>
                                    @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description" required>
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                            </div>
                            <div class="mb-3">
                                <label for="paid_at" class="form-label">Paid At</label>
                                <input type="datetime-local" class="form-control" id="paid_at" name="paid_at">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Salary</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Create Modal -->
    </x-slot>
</x-layouts.admin>