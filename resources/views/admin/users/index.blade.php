@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mb-0">Manage Employee</h2>
        <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex" style="max-width: 300px;">
            <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Search users...">
            <button type="submit" class="primary-btn3 ms-2">Search</button>
        </form>
    </div>

    <div class="text-end mb-3">
        <a href="{{ route('admin.contacts') }}" class="primary-btn3">📩 View Contact Messages</a>
    </div>

    @if($users->count())
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Employee Id</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Status</th> <!-- ✅ Added -->
                    <th>Report</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role == 'customer' ? 'Employee' : ucfirst($user->role) }}</td>
                    <td>{{ $user->employee_id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->user_phone_number }}</td>

                    <!-- ✅ Status column -->
                    <td>
                        @if($user->is_blocked)
                            <span style="color: red; font-weight: bold;">Blocked</span>
                        @else
                            <span style="color: green; font-weight: bold;">Active</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.employee.employee_report', $user->id) }}" class="btn btn-sm btn-primary">👁</a>
                        <a href="{{ route('admin.employee.create', $user->id) }}" class="btn btn-sm btn-primary">➕</a>
                    <a href="{{ route('admin.employee.create_multiple', $user->id) }}" class="btn btn-sm btn-success">
    ➕ Add More Reports
</a>

                    </td>

                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="primary-btn3">Edit</a>

                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="primary-btn3"
                                onclick="return confirm('Are you sure you want to delete this user?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p>No users found.</p>
    @endif
</div>
@endsection
