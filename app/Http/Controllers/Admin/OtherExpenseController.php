<?php

namespace App\Http\Controllers\Admin;

use App\Models\OtherExpense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OtherExpenseController extends Controller
{
    // Display all other expenses
    public function index()
    {
        $otherExpenses = OtherExpense::orderBy('incurred_at', 'desc')->get();
        return view('admin.costs.others-expense', ['otherExpenses' => $otherExpenses]);
    }

    // Store a new other expense
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric',
            'incurred_at' => 'required|date',
        ]);

        OtherExpense::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'incurred_at' => $request->incurred_at,
        ]);

        return redirect()->route('admin.expenses.others.index')->with('success', 'Other expense added successfully.');
    }

    // Update an existing other expense
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric',
            'incurred_at' => 'required|date',
        ]);

        $otherExpense = OtherExpense::findOrFail($id);
        $otherExpense->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'incurred_at' => $request->incurred_at,
        ]);

        return redirect()->route('admin.expenses.others.index')->with('success', 'Other expense updated successfully.');
    }

    // Delete an other expense
    public function destroy($id)
    {
        $otherExpense = OtherExpense::findOrFail($id);
        $otherExpense->delete();

        return redirect()->route('admin.expenses.others.index')->with('success', 'Other expense deleted successfully.');
    }
}
