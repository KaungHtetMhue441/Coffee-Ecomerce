@props([
    "breadCrumbs"=>['Tables','List']
])

<x-layouts.admin>
    <x-slot name="header">
        Tables Management
    </x-slot>

    <x-slot name="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">All Tables</h4>
                                <a href="{{ route('admin.tables.create') }}" class="btn btn-primary btn-round ml-auto">
                                    <i class="fa fa-plus"></i>
                                    Add Table
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Table</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tables as $table)
                                            <tr>
                                                <td>{{ $table->id }}</td>
                                                <td>{{ $table->table }}</td>
                                                <td>{{ $table->location }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $table->status === 'active' ? 'success' : 'danger' }}">
                                                        {{ ucfirst($table->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $table->created_at->format('Y-m-d H:i') }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('admin.tables.edit', $table) }}" class="btn btn-link btn-primary btn-lg">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.tables.destroy', $table) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Are you sure you want to delete this table?')">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No tables found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="d-flex justify-content-center mt-3">
                                {{ $tables->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts.admin>
