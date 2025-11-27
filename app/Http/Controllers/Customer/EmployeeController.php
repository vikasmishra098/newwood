<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Show all employees for the logged-in customer
     */
    public function index()
    {
        // Only show employees for the authorized customer
        $employees = Employee::where('customer_id', auth()->id())->get();

        return view('customer.employees.index', compact('employees'));
    }

    /**
     * Update employee status (processing/done)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:processing,done',
        ]);

        // Ensure employee belongs to the logged-in customer
        $employee = Employee::where('customer_id', auth()->id())->findOrFail($id);

        $employee->status = $request->status;
        $employee->save();

        return redirect()->route('customer.employees.index')
                         ->with('success', 'Employee status updated successfully.');
    }
}
