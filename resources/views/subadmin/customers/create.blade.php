@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Employee</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subadmin.customers.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
        </div>
        <div class="mb-3">
    <label for="user_phone_number">Phone Number</label>
    <input type="text" name="user_phone_number" class="form-control" value="{{ old('user_phone_number', $customer->user_phone_number ?? '') }}" required>
</div>

        
        <div class="mb-3">
            <label>Employee Id</label>
            <input type="text" name="employee_id" value="{{ old('employee_id') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Employee</button>
        <a href="{{ route('subadmin.customers.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
