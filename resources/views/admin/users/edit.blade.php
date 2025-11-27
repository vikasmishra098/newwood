@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User (Subadmin or Customer)</h2>

    @if ($errors->any())
        <div style="color:red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Name:</label><br>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div>
            <label>Employee Id</label><br>
            <input type="text" name="employee_id" value="{{ old('email', $user->employee_id) }}" required>
        </div>

        <div>
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        
        <div>
            <label>Phone No.</label><br>
            <input type="text" name="user_phone_number" value="{{ old('user_phone_number', $user->user_phone_number) }}" required>
        </div>
          <div>
    <label>Account Status:</label><br>
    <select name="is_blocked" required>
        <option value="0" {{ $user->is_blocked == 0 ? 'selected' : '' }}>Active</option>
        <option value="1" {{ $user->is_blocked == 1 ? 'selected' : '' }}>Blocked</option>
    </select>
</div>

        <div>
            <label>New Password (leave blank to keep current):</label><br>
            <input type="password" name="password">
        </div>
      


        <div>
            <label>Role:</label><br>
            <select name="role" required>
                <option value="subadmin" {{ $user->role == 'subadmin' ? 'selected' : '' }}>Subadmin</option>
                <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Employee</option>
            </select>
        </div>

        <br>
        <button type="submit">Update User</button>
    </form>
</div>
@endsection
