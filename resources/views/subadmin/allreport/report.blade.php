@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Employee Report</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>

                <th>Employee</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Designation</th>
                <th>Address</th>
                <th>Status</th>
                <th>Date</th>
                <th>Time</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>

                    <td>{{ $employee->username }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->designation }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>
                        <span class="badge bg-{{ $employee->status == 'done' ? 'success' : 'warning' }}">
                            {{ ucfirst($employee->status) }}
                        </span>
                    </td>
                    <td>{{ $employee->date ?? '—' }}</td>
                    <td>{{ $employee->time ?? '—' }}</td>
                    <td>{{ $employee->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="13" class="text-center text-muted">No records found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
