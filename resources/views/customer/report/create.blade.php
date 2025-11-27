@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Report</h2>

    <form action="{{ route('customer.report.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Report File</label>
            <input type="file" name="report_file" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Report</button>
    </form>
</div>
@endsection
