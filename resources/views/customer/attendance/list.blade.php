@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Attendance List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                
                <th>Employee Name</th>
                <th>Report Name </th>
                <th>Photo</th>
                <th>Location</th>
                <th>Action</th>
                <th>Date & Time</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 1; @endphp
            @forelse ($attendances as $attendance)
            @if($attendance->name == auth()->user()->name)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $attendance->name }}</td>
                    <td>{{ $attendance->employee->name ?? 'N/A' }}</td> <!-- Employee name from employees table -->
                    <td>
                        <img src="{{ asset('storage/app/public/attendance/' . basename($attendance->photo)) }}" width="200">
                    </td>
                    <td>{{ $attendance->location }}</td>
                    <td>{{ $attendance->type === 'out' ? 'Out' : 'In' }}</td>
                    <td>{{ \Carbon\Carbon::parse($attendance->datetime)->format('d M Y, h:i A') }}</td>
                </tr>
                @endif
            @empty
                <tr>
                    <td colspan="7">No attendance records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
