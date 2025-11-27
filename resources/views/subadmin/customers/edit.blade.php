@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Customer</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name', $customer->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email', $customer->email) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Phone No.</label>
            <input type="text" name="user_phone_number" value="{{ old('user_phone_number', $customer->user_phone_number) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Employee ID:</label>
            <input type="text" name="employee_id" value="{{ old('employee_id', $customer->employee_id) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>New Password (leave blank to keep current):</label>
            <input type="password" name="password" class="form-control">
        </div>

        <!-- ✅ Block / Unblock Option -->
        <div class="mb-3">
            <label>Account Status:</label>
            <select name="is_blocked" class="form-control">
                <option value="0" {{ old('is_blocked', $customer->is_blocked) == 0 ? 'selected' : '' }}>Active</option>
                <option value="1" {{ old('is_blocked', $customer->is_blocked) == 1 ? 'selected' : '' }}>Blocked</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Customer</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
