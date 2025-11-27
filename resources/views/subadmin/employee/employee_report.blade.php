@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Employee Report for {{ $customer->name }}</h2>

    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                  <th>#</th>
                  <th>Name</th>
                <th>Company Name</th>
                <!--th>Email</th-->
                <th>Phone</th>
                <th>Date</th>
                <th>Time</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
        @forelse($employees as $index => $employee)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $employee->name }}</td>
    <td>{{ $employee->company ? $employee->company->name : 'N/A' }}</td>
                <!--td>{{ $employee->email }}</td-->
                <td>{{ $employee->phone }}</td>
                 <td>{{ $employee->date }}</td> 
                    <td>{{ \Carbon\Carbon::parse($employee->time)->format('h:i A') }}</td>
                   
                <td>
                    <a href="{{ route(auth()->user()->role . '.employee.view', $employee->id) }}" class="btn btn-info btn-sm">View</a>
<!--                    <a href="{{ route(auth()->user()->role . '.employee.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route(auth()->user()->role . '.employee.delete', $employee->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                    </form>-->
                </td>
            </tr>
        @empty
            <tr><td colspan="5">No employees found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
