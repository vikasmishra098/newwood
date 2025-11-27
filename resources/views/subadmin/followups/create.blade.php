@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Followup for: {{ $query->qname }}</h2>

    <form action="{{ route('subadmin.followups.store') }}" method="POST">
        @csrf

        <input type="hidden" name="query_id" value="{{ $query->id }}">

        <div class="mb-3">
            <label for="fdate" class="form-label">Followup Date</label>
            <input type="date" name="fdate" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="fcomment" class="form-label">Comment</label>
            <textarea name="fcomment" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Add Followup</button>
    </form>
</div>
@endsection
