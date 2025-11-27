@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Employees</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Designation</th>
                <th>Address</th>
                <th>Status</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->designation }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>
                        <span class="badge 
                            {{ $employee->status == 'done' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($employee->status) }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('customer.employees.updateStatus', $employee->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="form-select">
                                <option value="processing" {{ $employee->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="done" {{ $employee->status == 'done' ? 'selected' : '' }}>Done</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
