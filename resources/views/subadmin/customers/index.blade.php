@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Employee Management</h2>

    <a href="{{ route('subadmin.customers.create') }}" class="btn btn-success mb-3">+ Add Employee</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by any field...">

    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
        <table class="table table-bordered table-striped" id="warrantyTable">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Employee ID</th>
                    <th>Status</th>
                    <th>Report</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $index => $customer)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->user_phone_number }}</td>
                        <td>{{ $customer->employee_id }}</td>

                        <!-- ✅ Show Active/Blocked in color -->
                        <td>
                            @if ($customer->is_blocked)
                                <span style="color: red; font-weight: bold;">Blocked</span>
                            @else
                                <span style="color: green; font-weight: bold;">Active</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('subadmin.employee.employee_report', $customer->id) }}" class="btn btn-sm btn-primary">👁</a>
                            <a href="{{ route('subadmin.employee.create', $customer->id) }}" class="btn btn-sm btn-primary">➕</a>
                            <a href="{{ route('subadmin.employee.create_multiple', $customer->id) }}" class="btn btn-sm btn-success">➕ Add More Reports</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No customers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <nav class="mt-3 d-flex justify-content">
            <ul class="pagination" id="pagination"></ul>
        </nav>
    </div>
</div>
@endsection
