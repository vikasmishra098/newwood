@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">Employee Performance</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Employee Name</th>
                    <th>Score</th>
                    
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($performances as $performance)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $performance->employee->company->name ?? 'N/A' }}</td>

                        <td>{{ $performance->score }}</td>
                        
                        <td>{{ \Carbon\Carbon::parse($performance->date)->format('d-m-Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No performance records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
