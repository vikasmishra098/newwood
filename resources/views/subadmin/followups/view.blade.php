@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Query: {{ $query->qname }}</h2>

    <a href="{{ route('subadmin.followups.create', $query->id) }}" class="btn btn-primary mb-3">Add Followup</a>

    @foreach($query->followups as $followup)
        <div class="card mb-3">
            <div class="card-header">
                Date: {{ $followup->fdate }}
            </div>
            <div class="card-body">
                <p><strong>Comment:</strong> {{ $followup->fcomment }}</p>
                <a href="{{ route('subadmin.followups.edit', $followup->id) }}" class="btn btn-sm btn-warning">Edit</a>
            </div>
        </div>
    @endforeach
</div>
@endsection
