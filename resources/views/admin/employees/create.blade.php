@props([
"breadCrumbs"=>['Employee','Create']
])
<x-layouts.admin>
    <x-slot name="header">
        Create Employee
    </x-slot>

    <x-slot name="script">

    </x-slot>
    <x-admin.breadcrumbs :items="$breadCrumbs">

    </x-admin.breadcrumbs>
    <x-slot name="content">
        <div class="container mt-5">
            <h1>Add Employee</h1>
            <form action="{{ route('admin.employees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
                    @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone">
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cv" class="form-label">CV</label>
                    <input type="file" class="form-control @error('cv') is-invalid @enderror" id="cv" name="cv">
                    @error('cv')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address">
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Add Employee</button>
            </form>
        </div>
    </x-slot>
</x-layouts.admin>