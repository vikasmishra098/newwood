@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Visit List</h2>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('subadmin.warranties.create') }}" class="btn btn-primary mb-3">➕ Visit List</a>

    <!-- 🔍 Search -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by any field...">

    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
        <table class="table table-bordered table-striped" id="warrantyTable">
            <thead >
                <tr>
                    <th>#</th>
                    <th>Company Name</th>
                    <th>Machine Name</th>
                    <th>Date</th>
                    <th>Machine Serial Number</th>
                    <th>Required Parts</th>
                    <th>Receive parts</th>
                    <th>Start Time</th>
                    
                    <!--th>Actions</th-->
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach($warranties as $key => $warranty)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $warranty->name }}</td>
                    <td>{{ $warranty->email }}</td>
                    <td>{{ $warranty->date }}</td>
                    
                    <td>{{ $warranty->city }}</td>
                    <td>{{ $warranty->mobile_number }}</td>
                    <td>{{ $warranty->model }}</td>
                    <td>{{ $warranty->vehicle_number }}</td>
                    
                    
                    <!--td>
                        <a href="{{ route('subadmin.warranties.edit', $warranty->id) }}" class="btn btn-sm btn-warning">✏️</a>
                        
                    </td-->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav class="mt-3 d-flex justify-content">
        <ul class="pagination" id="pagination"></ul>
    </nav>
</div>

<!-- JavaScript Pagination & Search -->

@endsection
