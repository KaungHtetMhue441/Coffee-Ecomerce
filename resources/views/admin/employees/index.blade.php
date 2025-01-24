@props([
"breadCrumbs"=>['Expense','salaries']
])
<x-layouts.admin>
    <x-slot name="header">
        Employee
    </x-slot>

    <x-slot name="script">

    </x-slot>
    <x-admin.breadcrumbs :items="$breadCrumbs">

    </x-admin.breadcrumbs>
    <x-slot name="content">
        <div class="container mt-5">
            <h1>Employee List</h1>
            <a href="{{ route('admin.employees.create') }}" class="btn btn-primary mb-3">Add Employee</a>

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>CV</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td><img src="{{ asset('storage/employees/photos/' . $employee->photo) }}" alt="Photo" width="50"></td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>
                            @if ($employee->cv)
                            <a href="{{ asset('storage/employees/cvs/' . $employee->cv) }}" target="_blank">View CV</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-slot>
</x-layouts.admin>