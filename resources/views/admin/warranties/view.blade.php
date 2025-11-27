@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Visit List</h2>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.warranties.create') }}" class="btn btn-primary mb-3">➕ Visit List</a>
<input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by any field...">

    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
        <table class="table table-bordered table-striped" id="warrantyTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>City</th>
                <th>Mobile</th>
                <th>Model</th>
                <th>Vehicle No.</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($warranties as $key => $warranty)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $warranty->name }}</td>
                <td>{{ $warranty->email }}</td>
                <td>{{ $warranty->city }}</td>
                <td>{{ $warranty->mobile_number }}</td>
                <td>{{ $warranty->model }}</td>
                <td>{{ $warranty->vehicle_number }}</td>
                <td>{{ $warranty->date }}</td>
                <td>
                 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

 <nav class="mt-3 d-flex justify-content">
        <ul class="pagination" id="pagination"></ul>
    </nav>

</div>
</div>
@endsection
