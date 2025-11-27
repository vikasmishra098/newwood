<?php

namespace App\Http\Controllers\Subadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;


class EmployeeController extends Controller
{
    public function employeeReport($id)
    {
        $customer = User::findOrFail($id);
        $employees = Employee::where('customer_id', $customer->id)
                ->orderBy('date', 'desc')   // latest date first
                ->orderBy('time', 'desc')   // latest time first
                ->get();

        return view(auth()->user()->role == 'admin' ? 'admin.employee.employee_report' : 'subadmin.employee.employee_report', compact('customer', 'employees'));
    }
    public function createMultiple($customer_id)
{
    $companies = \App\Models\Company::all();
    $customer = \App\Models\User::findOrFail($customer_id);

    return view('subadmin.employee.create_multiple', compact('companies', 'customer'));
}

public function storeMultiple(Request $request)
{
    $request->validate([
        'task_name'    => 'required|string|max:255',
        'employee_ids' => 'required|array|min:1',
        'date'         => 'required|date',
        'time'         => 'required',
        'email'        => 'nullable|email',
        'phone'        => 'nullable|string|max:20',
        'designation'  => 'nullable|string|max:255',
        'address'      => 'nullable|string|max:1000',
        'company_id'   => 'required|exists:companies,id', // ensures FK constraint is valid
    ]);

    foreach ($request->employee_ids as $employeeId) {
        $employeeUser = \App\Models\User::find($employeeId);

        \App\Models\Employee::create([
           'customer_id' => $request->customer_id,
                'username'    => $employeeUser->name,
                'name'        => $request->task_name,
                'email'       => $request->email,
                'date'        => $request->date,
                'time'        => $request->time,
                'designation' => $request->notes ?? '',
                'address'     => $request->address ?? '',
                'phone'       => $request->mobile ?? '',
                'company_id'  => $request->company_id,
        ]);
    }

    return redirect()->route('subadmin.customers.index')
                     ->with('success', 'Report created successfully for selected employees!');
}




  public function create($customer_id)
{
    $customer = User::findOrFail($customer_id);
    $companies = \App\Models\Company::all();
    return view(auth()->user()->role . '.employee.create', [
        'customer_id' => $customer->id,
        'customer_name' => $customer->name,
        'companies' => $companies,  

    ]);
    
}

public function store(Request $request)
{
    $request->validate([
        'customer_id' => 'required|exists:users,id',
        'company_id'  => 'required|exists:companies,id',
        'name'        => 'required|string|max:255',
        'username'        => 'required|string|max:255',
        'email'       => 'nullable|email',
        'phone'       => 'nullable|string',
        'designation' => 'nullable|string',
        'address'     => 'nullable|string',
        'date'        => 'required|date',
        'time'        => 'required',
    ]);

    Employee::create($request->all());

    return redirect()->route(auth()->user()->role . '.employee.employee_report', $request->customer_id)
                     ->with('success', 'Employee added successfully.');
}



    public function view($id)
    {
        $employee = Employee::findOrFail($id);
        return view(auth()->user()->role . '.employee.view', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view(auth()->user()->role . '.employee.edit', compact('employee'));
    }

    public function destroy($id)
    {
        Employee::destroy($id);
        return back()->with('success', 'Employee deleted successfully.');
    }

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
}
