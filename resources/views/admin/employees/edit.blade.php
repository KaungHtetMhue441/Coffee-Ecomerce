@props([
"breadCrumbs"=>['Employee','edit']
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
            <h1>Edit Employee</h1>
            <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $employee->name) }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <div class="mb-2">
                        @if ($employee->photo)
                        <img src="{{ asset('storage/employees/photos/' . $employee->photo) }}" alt="Photo" width="100">
                        @else
                        <p>No photo uploaded.</p>
                        @endif
                    </div>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
                    @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $employee->phone) }}">
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $employee->email) }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cv" class="form-label">CV</label>
                    <div class="mb-2">
                        @if ($employee->cv)
                        <a href="{{ asset('/employees/cvs/' . $employee->cv) }}" target="_blank">View Current CV</a>
                        @else
                        <p>No CV uploaded.</p>
                        @endif
                    </div>
                    <input type="file" class="form-control @error('cv') is-invalid @enderror" id="cv" name="cv">
                    @error('cv')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $employee->address) }}">
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Update Employee</button>
                <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </x-slot>
</x-layouts.admin>