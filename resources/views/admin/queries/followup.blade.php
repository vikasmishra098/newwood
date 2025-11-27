@extends('layouts.app') <!-- or your layout -->

@section('content')
<div class="container">
    <h3>Add Follow-Up</h3>

    <form action="{{ route('admin.queries.followup.store', $query->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="fdate">Follow-up Date</label>
            <input type="datetime-local" name="fdate" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="fcomment">Follow-up Comment</label>
            <textarea name="fcomment" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Add Follow-up</button>
    </form>

    <hr>

    <h4>Previous Timeline Entries</h4>
    @if($query->qtimeline)
        @foreach(json_decode($query->qtimeline, true) as $entry)
            <div class="border p-2 mb-2">
                <strong>{{ $entry['time'] }}</strong><br>
                {{ $entry['comment'] }}
            </div>
        @endforeach
    @endif
</div>
@endsection
