<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::latest()->paginate(10);
        return view('admin.tables.index', compact('tables'));
    }

    public function create()
    {
        $statuses = Table::getStatuses();
        return view('admin.tables.create', compact('statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'table' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        Table::create($validated);

        return redirect()
            ->route('admin.tables.index')
            ->with('success', 'Table created successfully.');
    }

    public function edit(Table $table)
    {
        $statuses = Table::getStatuses();
        return view('admin.tables.edit', compact('table', 'statuses'));
    }

    public function update(Request $request, Table $table)
    {
        $validated = $request->validate([
            'table' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $table->update($validated);

        return redirect()
            ->route('admin.tables.index')
            ->with('success', 'Table updated successfully.');
    }

    public function destroy(Table $table)
    {
        $table->delete();

        return redirect()
            ->route('admin.tables.index')
            ->with('success', 'Table deleted successfully.');
    }
}
