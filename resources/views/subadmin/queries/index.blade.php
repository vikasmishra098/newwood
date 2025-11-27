@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Task (Subadmin)</h2>
    <a href="{{ route('subadmin.queries.create') }}" class="btn btn-primary mb-3">Create task</a>

    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by any field...">

   
    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
        <table class="table table-bordered table-striped" id="warrantyTable">
        <thead>
            <tr>
                <th>Name</th>
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
            @foreach ($queries as $query)
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
                        <a href="{{ route('subadmin.queries.show', $query->id) }}" class="btn btn-sm btn-info">Show</a>
                        <!--a href="{{ route('subadmin.queries.edit', $query->id) }}" class="btn btn-sm btn-warning">Edit</a-->
                        <a href ="{{ route('subadmin.followups.create', $query->id) }}" class="btn btn-sm btn-warning">follow</a>
                        <!--form action="{{ route('subadmin.queries.destroy', $query->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete this query?')" class="btn btn-sm btn-danger">Delete</button>
                        </form-->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

<nav class="mt-3 d-flex justify-content">
        <ul class="pagination" id="pagination"></ul>
    </nav>
</div>

</div>
@endsection
