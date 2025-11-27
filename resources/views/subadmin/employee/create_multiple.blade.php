@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Employee Report </h2>

    <form action="{{ route('subadmin.employee.storeMultiple') }}" method="POST">
        @csrf
        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
<div class="mb-3">
    <label>Company</label>
    <select name="company_id" class="form-control" required>
        <option value="">-- Select Company --</option>
        @foreach(\App\Models\Company::all() as $company)
            <option value="{{ $company->id }}">{{ $company->name }}</option>
        @endforeach
    </select>
</div>
 <div class="mb-3">
            <label>Select Employees</label>
            <select name="employee_ids[]" class="form-control" multiple required>
                @foreach(\App\Models\User::where('role', 'customer')->get() as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }} ({{ $employee->employee_id }})</option>
                @endforeach
            </select>
            <small>Hold Ctrl (Windows) / Cmd (Mac) to select multiple employees</small>
        </div>

        <div class="mb-3">
            <label> Customer Name</label>
            <input type="text" name="task_name" class="form-control" required>
        </div>

       <div class="mb-3">
            <label> Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label> Phone:</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label> Address:</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Additional Notes</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label>Time</label>
            <input type="time" name="time" class="form-control" value="{{ date('H:i') }}" required>
        </div>

        

        <button type="submit" class="btn btn-primary">Save Report</button>
    </form>
</div>
@endsection
