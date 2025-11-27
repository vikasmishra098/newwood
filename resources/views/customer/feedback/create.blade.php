@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Feedback</h2>

    <form action="{{ route('customer.feedback.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Feedback File</label>
            <input type="file" name="feedback_file" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Feedback</button>
    </form>
</div>
@endsection
