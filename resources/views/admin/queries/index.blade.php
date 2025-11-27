@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All task</h2>
    <a href="{{ route('admin.queries.create') }}" class="btn btn-primary mb-3">➕ Add New  Task</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
<div class="table-responsive">
    <table class="table table-bordered"style = "background:#171717;color:white">
        <thead>
            <tr>
                <th>Q. Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Target date</th>
                <th>Target date work </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($queries as $query)
            <tr>
                <tr>
    <td>{{ $query->qname }}</td>
    <td>{{ $query->qemail }}</td>
    <td>{{ $query->qphone }}</td>
    <td>{{ $query->qcar }}</td>
    <td>{{ $query->qstatus }}</td>
    <td>{{ $query->qpriority }}</td>

    @php
        $daysLeft = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($query->qtarget_date), false);
    @endphp

    <td>{{ $query->qtarget_date }}</td>
    <td>

    @if($query->qstatus == 'Closed')
        <span style="color:red; font-weight:bold;">Closed</span>
    @else
        @if($daysLeft < 0)
            <span style="color:red;">Overdue {{ abs($daysLeft) }} day{{ abs($daysLeft)==1?'':'s' }}</span>
        @elseif($daysLeft == 0)
            <span style="color:green;">Today</span>
        @else
            <span style="color:orange;">{{ $daysLeft }} day{{ $daysLeft==1?'':'s' }} left</span>
        @endif
    @endif

</td>


    

                <td>
                    <a href="{{ route('admin.followups.create', $query->id) }}" class="btn btn-info btn-sm">Add Follow Up</a>
                    <a href="{{ route('admin.queries.show', $query->id) }}" class="btn btn-info btn-sm">👁</a>
                    <a href="{{ route('admin.queries.edit', $query->id) }}" class="btn btn-warning btn-sm">✏</a>
                    <form action="{{ route('admin.queries.destroy', $query->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this query?')">🗑</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
