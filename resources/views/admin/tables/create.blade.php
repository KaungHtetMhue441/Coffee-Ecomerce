@props([
"breadCrumbs"=>['Tables','Create']
])

<x-layouts.admin>
    <x-slot name="header">
        Create New Table
    </x-slot>

    <x-slot name="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div ifyass=" row align-items-center justify-content-between">
                                <h4 class="card-title">Add New Table</h4>
                                <a href="{{ route('admin.tables.index') }}" class="btn btn-primary btn-round ml-auto">
                                    <i class="fa fa-arrow-left"></i>
                                    Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form action="{{ route('admin.tables.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="table">Table Number/Name</label>
                                    <input type="text" class="form-control" id="table" name="table" value="{{ old('table') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        @foreach($statuses as $value => $label)
                                        <option value="{{ $value }}" {{ old('status') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Create Table</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts.admin>