@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Employee Details</h2>
    
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title">{{ $employee->name }}</h4>
            <p><strong>Email:</strong> {{ $employee->email }}</p>
            <p><strong>Phone:</strong> {{ $employee->phone }}</p>
            <p><strong>Designation:</strong> {{ $employee->designation ?? 'N/A' }}</p>
            <p><strong>Address:</strong> {{ $employee->address ?? 'N/A' }}</p>
        </div>
    </div>

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">⬅ Back</a>
</div>
@endsection
