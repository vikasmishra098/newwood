@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Company List</h2>
    <a href="{{ route('subadmin.companies.create') }}" class="btn btn-primary mb-3">➕ Add Company</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Company Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $sl = 1 @endphp
            @foreach($companies as $key => $company)
            @if($company->comservicehidden == 1)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->created_at->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('subadmin.companies.edit', $company->id) }}" class="btn btn-sm btn-info">✏️ Edit</a>
                    <!--form action="{{ route('subadmin.companies.destroy', $company->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">🗑️ Delete</button>
                    </form-->
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
