@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Followup</h2>

    <form action="{{ route('subadmin.followups.update', $followup->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="fdate" class="form-label">Followup Date</label>
            <input type="date" name="fdate" value="{{ $followup->fdate }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="fcomment" class="form-label">Comment</label>
            <textarea name="fcomment" class="form-control" required>{{ $followup->fcomment }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Followup</button>
    </form>
</div>
@endsection
