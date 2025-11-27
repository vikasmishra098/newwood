@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Task Details</h2>

    <table class="table table-bordered">
        <tr><th>Name</th><td>{{ $query->qname }}</td></tr>
        <tr><th>Email</th><td>{{ $query->qemail }}</td></tr>
        <tr><th>Phone</th><td>{{ $query->qphone }}</td></tr>
        <tr><th>Address</th><td>{{ $query->qcar }}</td></tr>
        <tr><th>Follow</th><td>{{ $query->qfollow }}</td></tr>
        <tr><th>Priority</th><td>{{ $query->qpriority }}</td></tr>
        <tr><th>Status</th><td>{{ $query->qstatus }}</td></tr>
        <tr><th>Created At</th><td>{{ $query->created_at }}</td></tr>
    </table>

    <h4>⏱ Timeline</h4>
    @php $timeline = json_decode($query->qtimeline, true); @endphp
    @if($timeline)
        <ul class="list-group">
            @foreach($timeline as $entry)
                <li class="list-group-item">
                    <strong>{{ $entry['time'] }}:</strong> {{ $entry['comment'] }}
                </li>
            @endforeach
        </ul>
    @else
        <p>No timeline data available.</p>
    @endif

    <a href="{{ route('subadmin.queries.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    
    
      <center><h4>📌 Follow Ups</h4> </center>

@if($query->followups->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Comment</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($query->followups as $f)
                <tr>
                    <td>{{ $f->fdate }}</td>
                    <td>{{ $f->fcomment }}</td>
                    <td>{{ $f->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No followups yet.</p>
@endif
    
    
</div>
@endsection
