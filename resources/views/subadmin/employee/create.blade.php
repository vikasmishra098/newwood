@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Employee</h2>

    <form action="{{ route(auth()->user()->role . '.employee.store') }}" method="POST">
        @csrf

<input type="hidden" name="customer_id" value="{{ $customer_id }}">

       <div class="form-group">
        <label for="company_id">Company</label>
        <select name="company_id" class="form-control" required>
            <option value="">-- Select Company --</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
        </select>
    </div>
     <div class="form-group">
        <label>Employee Name</label>
        <input type="text" name="username" class="form-control" value="{{ $customer_name }}" readonly>
    </div>
    
    <div class="form-group">
        <label>Customer Name</label>
        <input type="text" name="name" class="form-control"  required>
    </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>Phone:</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label>Designation:</label>
            <input type="text" name="designation" class="form-control">
        </div>

        <div class="mb-3">
            <label>Address:</label>
            <textarea name="address" class="form-control"></textarea>
        </div>
        
        <div class="form-group">
        <label>Date</label>
        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
    </div>

    <div class="form-group">
        <label>Time</label>
        <input type="time" name="time" class="form-control" value="{{ date('H:i') }}">
    </div>

        <button type="submit" class="btn btn-primary">Add Employee</button>
    </form>
</div>
@endsection
