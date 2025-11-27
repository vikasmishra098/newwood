@extends('layouts.app')

@section('content')
<div class="container">
    <h2>AMC List</h2>
    <a href="{{ route('admin.amcvisit.create') }}" class="btn btn-primary mb-3">➕ Add Company</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Company Name</th>
                <th>comservicehidden</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $sl = 1; @endphp
            @foreach($companies as $key => $company)
            @if($company->comservicehidden == 2)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->comservicehidden }}</td>
                <td>{{ $company->created_at->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('admin.amcvisit.edit', $company->id) }}" class="btn btn-sm btn-info">✏️ </a>
                    <form action="{{ route('admin.amcvisit.destroy', $company->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">🗑</button>
                    </form>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
