<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    // Display all salaries
    public function index()
    {
        $salaries = Salary::all(); // Fetch all salary records
        $employees = Employee::all();
        return view('admin.costs.salaries', compact('salaries', 'employees'));
    }

    // Store a new salary
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'employee_id' => 'required|integer',
            'description' => "required|string",
            'amount' => 'required|numeric',
            'paid_at' => 'nullable|date',
        ]);

        Salary::create([
            'employee_id' => $request->employee_id,
            'description' => $request->description,
            'amount' => $request->amount,
            'incurred_at' => $request->paid_at,
        ]);

        return redirect()->route('admin.salaries.index')->with('success', 'Salary added successfully.');
    }

    // Update an existing salary
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|integer',
            'amount' => 'required|numeric',
            'paid_at' => 'nullable|date',
        ]);

        $salary = Salary::findOrFail($id);
        $salary->update([
            'employee_id' => $request->employee_id,
            'amount' => $request->amount,
            'paid_at' => $request->paid_at,
        ]);

        return redirect()->route('admin.salaries.index')->with('success', 'Salary updated successfully.');
    }

    // Delete a salary
    public function destroy($id)
    {
        $salary = Salary::findOrFail($id);
        $salary->delete();

        return redirect()->route('admin.salaries.index')->with('success', 'Salary deleted successfully.');
    }
}
