@extends('layouts.app') {{-- or your correct layout file --}}

@section('content')
    <div class="container">
        <h4>My Warranties</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('customer.warranties.create') }}" class="btn btn-primary mb-3">➕ Add Warranty</a>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($warranties as $w)
                <tr>
                    <td>{{ $w->name }}</td>
                    <td>{{ $w->email }}</td>
                    <td>
                        <a href="{{ route('customer.warranties.edit', $w->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('customer.warranties.destroy', $w->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
