@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Visit History</h2>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Employee</th>
                <th>Company</th>
                <th>Machine</th>
                <th>Date</th>
                <th>Status</th>
                <th>Who Solve</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visits as $key => $visit)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $visit->employee_name }}</td>
                <td>{{ $visit->company->name }}</td>
                <td>{{ $visit->machine_name }}</td>
                <td>{{ $visit->date }}</td>
                <td>{{ ucfirst($visit->status) }}</td>
                <td>{{ $visit->who_solve }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
