@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create User (Subadmin or Employee)</h2>

    @if ($errors->any())
        <div style="color:red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div>
            <label>Name:</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label>Employee Id</label><br>
            <input type="text" name="employee_id" value="{{ old('employee_id') }}" required>
        </div>
        
        
        <div>
            <label>Phone No.</label><br>
            <input type="text" name="user_phone_number" value="{{ old('user_phone_number') }}" required>
        </div>

        <div>
            <label>Password:</label><br>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>Role:</label><br>
            <select name="role" required>
                <option value="">Select Role</option>
                <option value="subadmin" {{ old('role') == 'subadmin' ? 'selected' : '' }}>Subadmin</option>
                <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Employee</option>
            </select>
        </div>

        <br>
        <button type="submit">Create User</button>
    </form>
</div>
@endsection
