@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Visit List</h2>

    <form method="GET" action="{{ route('subadmin.visits.index') }}">
    <div class="row">
        <div class="col-sm-6 mb-3">
            <label for="month" class="form-label">Month:</label>
            <select name="month" id="month" class="form-control">
                <option value="">-- Select Month --</option>
                @foreach(range(1, 12) as $m)
                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-6 mb-3">
            <label for="year" class="form-label">Year:</label>
            <select name="year" id="year" class="form-control">
                <option value="">-- Select Year --</option>
                @foreach(range(now()->year, now()->year - 10) as $y)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="{{ route('subadmin.visits.index') }}" class="btn btn-secondary">Reset</a>
</div>



    <a href="{{ route('subadmin.visits.create') }}" class="btn btn-success mb-3">Add Visit</a>

    <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Employee</th>
            <th>Company</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($visits as $visit)
            <tr>
                <td>{{ $visit->id }}</td>
                <td>{{ $visit->employee->name ?? 'N/A' }}</td>
                <td>{{ $visit->company->name ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('subadmin.visits.edit', $visit->id) }}" class="btn btn-sm btn-warning">View</a>
                    
    <!--form action="{{ route('subadmin.visits.destroy', $visit->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
</form-->

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No visits found for selected month.</td>
            </tr>
        @endforelse
    </tbody>
</table>

</div>
@endsection
