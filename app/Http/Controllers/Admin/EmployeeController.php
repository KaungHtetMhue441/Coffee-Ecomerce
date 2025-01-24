<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employees.index', compact(var_name: 'employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'address' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = uploadFile($request->file('photo'), '/employees/photos/');
        }

        if ($request->hasFile('cv')) {
            $data['cv'] = uploadFile($request->file('cv'), '/employees/cvs/');
        }

        Employee::create($data);

        return redirect()->route('admin.employees.index')->with('success', 'Employee added successfully.');
    }

    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'address' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($employee->photo) {
                deleteFile('/employees/photos/', $employee->photo);
            }
            $data['photo'] = uploadFile($request->file('photo'), '/employees/photos/');
        }

        if ($request->hasFile('cv')) {
            if ($employee->cv) {
                deleteFile('/employees/cvs/', $employee->cv);
            }
            $data['cv'] = uploadFile($request->file('cv'), '/employees/cvs/');
        }

        $employee->update($data);

        return redirect()->route('admin.employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->photo) {
            deleteFile('/employees/photos/', $employee->photo);
        }

        if ($employee->cv) {
            deleteFile('/employees/cvs/', $employee->cv);
        }

        $employee->delete();

        return redirect()->route('admin.employees.index')->with('success', 'Employee deleted successfully.');
    }
}
