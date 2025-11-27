<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Company;

class EmployeeController extends Controller
{
    /**
     * Show employee report list for a specific customer
     */
    public function employeeReport($id)
    {
        $customer = User::findOrFail($id);
        $employees = Employee::where('customer_id', $customer->id)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        $view = auth()->user()->role === 'admin'
            ? 'admin.employee.employee_report'
            : 'subadmin.employee.employee_report';

        return view($view, compact('customer', 'employees'));
    }

    /**
     * Show form to create multiple employee reports for one customer
     */
    public function createMultiple($customer_id)
    {
        $companies = Company::all();
        $customer = User::findOrFail($customer_id);

        return view('admin.employee.create_multiple', compact('companies', 'customer'));
    }

    /**
     * Store multiple employee reports at once
     */
 public function storeMultiple(Request $request)
{
    $request->validate([
        'customer_id'  => 'required|exists:users,id',
        'company_id'   => 'required|exists:companies,id',
        'task_name'    => 'required|string|max:255',
        'employee_ids' => 'required|array|min:1',
        'date'         => 'required|date',
        'time'         => 'required',
        'email'        => 'nullable|email',
        'phone'        => 'nullable|string|max:20',
        'address'      => 'nullable|string|max:1000',
        'notes'        => 'nullable|string',
    ]);

    foreach ($request->employee_ids as $employeeId) {
        $employeeUser = User::findOrFail($employeeId);

        Employee::create([
            'customer_id' => $request->customer_id,
            'company_id'  => $request->company_id,
            'username'    => $employeeUser->name,
            'name'        => $request->task_name,
            'email'       => $employeeUser->email ?? $request->email,
            'phone'       => $employeeUser->phone ?? $request->phone,
            'designation' => $request->notes ?? '',
            'address'     => $request->address ?? '',
            'date'        => $request->date,
            'time'        => $request->time,
        ]);
    }

    return redirect()->route('admin.users.index')->with('success', 'Reports created successfully for all selected employees!');
}



    /**
     * Show single create form
     */
    public function create($customer_id)
    {
        $customer = User::findOrFail($customer_id);
        $companies = Company::all();
        $users = User::where('role', '!=', 'admin')->get();

        $viewPath = auth()->user()->role === 'admin'
            ? 'admin.employee.create'
            : 'subadmin.employee.create';

        return view($viewPath, [
            'customer_id' => $customer->id,
            'customer_name' => $customer->name,
            'companies' => $companies,
            'users' => $users,
        ]);
    }

    /**
     * Store single employee report
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'company_id' => 'required|exists:companies,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'required|string|max:15',
            'designation' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:1000',
             'date' => 'nullable|date',
            'time' => 'required',
        ]);

        $user = User::findOrFail($request->user_id);

        $employee = Employee::create([
            'customer_id' => $request->customer_id,
            'company_id' => $request->company_id,
            'username' => $user->name,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'address' => $request->address,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        // ✅ WhatsApp message
        $message = "Hello {$employee->username}, your report has been added.\n\n";
        $message .= "Employee Name: {$employee->name}\n";
        $message .= "Designation: {$employee->designation}\n";
        $message .= "Address: {$employee->address}\n";
        $message .= "Date: {$employee->date}\n";
        $message .= "Time: {$employee->time}\n";

        $phone = preg_replace('/[^0-9]/', '', $employee->phone);
        $whatsappUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

        return redirect($whatsappUrl);
    }

    /**
     * Update employee report status (processing/done)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:processing,done',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->status = $request->status;
        $employee->save();

        return redirect()->back()->with('success', 'Employee status updated successfully.');
    }

    /**
     * View a specific employee report
     */
    public function view($id)
    {
        $employee = Employee::findOrFail($id);
        return view(auth()->user()->role . '.employee.view', compact('employee'));
    }

    /**
     * Edit a specific employee report
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view(auth()->user()->role . '.employee.edit', compact('employee'));
    }

    /**
     * Update employee report data
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'address' => $request->address,
        ]);

        return redirect()->route(auth()->user()->role . '.employee.employee_report', $employee->customer_id)
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Delete employee report
     */
    public function destroy($id)
    {
        Employee::destroy($id);
        return back()->with('success', 'Employee deleted successfully.');
    }
}
