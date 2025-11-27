
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mb-4">
    <a href="{{ route('subadmin.followups.index', ['filter' => 'all']) }}" 
       class="btn btn-primary {{ $filter == 'all' ? 'active' : '' }}">All</a>

    <a href="{{ route('subadmin.followups.index', ['filter' => 'today']) }}" 
       class="btn btn-primary {{ $filter == 'today' ? 'active' : '' }}">Today</a>

    <a href="{{ route('subadmin.followups.index', ['filter' => 'yesterday']) }}" 
       class="btn btn-secondary {{ $filter == 'yesterday' ? 'active' : '' }}">Yesterday</a>

    <a href="{{ route('subadmin.followups.index', ['filter' => 'closed']) }}" 
       class="btn btn-danger {{ $filter == 'closed' ? 'active' : '' }}">Closed</a>
</div>


    @forelse($followups as $followup)
        <div class="card mb-3">
            <div class="card-header">
                Query: {{ $followup->relatedQuery->qname ?? 'N/A' }} ({{ $followup->fdate }})
            </div>
            <div class="card-body">
                <p><strong>Comment:</strong> {{ $followup->fcomment }}</p>
                <a href="{{ route('subadmin.followups.edit', $followup->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <a href="{{ route('subadmin.followups.view', $followup->relatedQuery->id) }}" class="btn btn-sm btn-info">View</a>
            </div>
        </div>
    @empty
        <p>No followups found for {{ ucfirst($filter) }}.</p>
    @endforelse
</div>
@endsection

