@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard</h2>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <p>Your role: <strong>{{ Auth::user()->role }}</strong></p>

    {{-- Admin View --}}
    @if(Auth::user()->role === 'admin')
    <div class="row g-3 my-3">
        <!-- Manage Employee  -->
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <h6 class="card-title">Manage Employee </h6>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-info">📃 View All</a>
                </div>
            </div>
        </div>

        <!-- Add Employee User -->
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <h6 class="card-title">Add Employee User</h6>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-outline-info">➕ Add User</a>
                </div>
            </div>
        </div>

        <!-- Contact Messages -->
        <!--div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <h6 class="card-title">Contact Messages</h6>
                    <a href="{{ route('admin.contacts') }}" class="btn btn-outline-info">👀 View Messages</a>
                </div>
            </div>
        </div-->

        <!-- Service Requests -->
        <!--div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <h6 class="card-title">Service Requests</h6>
                    <a href="{{ route('admin.service-requests') }}" class="btn btn-outline-info">📌 View Requests</a>
                </div>
            </div>
        </div-->

        <!-- Contact Form Messages -->
        <!--div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <h6 class="card-title">Form Contact Messages</h6>
                    <a href="{{ route('admin.contact.messages') }}" class="btn btn-outline-info">📩 View Forms</a>
                </div>
            </div>
        </div-->

        <!-- View Warranties -->
        <!--div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <h6 class="card-title">Visit Records</h6>
                    <a href="{{ route('admin.warranties.index') }}" class="btn btn-outline-info">📋 View Warranties</a>
                </div>
            </div>
        </div-->

        <!-- Visit List -->
        <!--div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <h6 class="card-title">Visit List</h6>
                    <a href="{{ route('admin.warranties.create') }}" class="btn btn-outline-info">➕ Visit List</a>
                </div>
            </div>
        </div-->
        
        
        
        
        
        
        
<div class="container">
    <h2>Attendance List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filter Form -->
    <div class="form-inline mb-3">
        <div class="form-group mr-2">
            <label for="filter-month" class="mr-2">Month:</label>
            <select id="filter-month" class="form-control">
                <option value="">All</option>
                @foreach(range(1, 12) as $m)
                    <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mr-2">
            <label for="filter-year" class="mr-2">Year:</label>
            <select id="filter-year" class="form-control">
                <option value="">All</option>
                @for($y = date('Y'); $y >= 2020; $y--)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </select>
        </div>

        <div class="form-group mr-2">
            <label for="filter-name" class="mr-2">Employee Name:</label>
            <select id="filter-name" class="form-control">
                <option value="">All</option>
                @foreach($attendances->pluck('name')->unique() as $name)
                    <option value="{{ $name }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary" onclick="filterAttendance()">Search</button>
        <button id="print-button" class="btn btn-success ml-2" style="display:none;" onclick="printFiltered()">Print</button>
    </div>

    <!-- Total Count Display -->
    <p><strong>Total Attendance:</strong> <span id="attendance-count">{{ $attendances->count() }}</span></p>

    <!-- Attendance Table -->
    <div class="scrollmenu mb-4" style="display:none">
        <table class="table table-bordered" id="attendance-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Employee Name</th>
                    <th>Photo</th>
                    <th>Location</th>
                    <th>Reach Time</th>
                    <th>Target Time</th>
                    <th>Performance</th>
                </tr>
            </thead>
            <tbody >

                @forelse ($attendances as $attendance)
                    <tr data-name="{{ $attendance->name }}"
                        data-month="{{ \Carbon\Carbon::parse($attendance->datetime)->format('n') }}"
                        data-year="{{ \Carbon\Carbon::parse($attendance->datetime)->format('Y') }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $attendance->name }}</td>
                        <td>
                            <img src="{{ asset('storage/app/public/attendance/' . basename($attendance->photo)) }}" width="200">
                        </td>
                        <td>{{ $attendance->location }}</td>
                        <td>{{ \Carbon\Carbon::parse($attendance->datetime)->format('d M Y, h:i A') }}</td>
                        <td>
                            @if(!empty($attendance->employee?->date) && !empty($attendance->employee?->time))
                                {{ \Carbon\Carbon::parse($attendance->employee->date . ' ' . $attendance->employee->time)->format('d M Y, h:i A') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @php
                                if (!empty($attendance->employee?->date) && !empty($attendance->employee?->time)) {
                                    $actual = \Carbon\Carbon::parse($attendance->datetime);
                                    $expected = \Carbon\Carbon::parse($attendance->employee->date . ' ' . $attendance->employee->time);
                                    $diffMinutes = $expected->diffInMinutes($actual, false);
                                } else {
                                    $diffMinutes = null;
                                }
                            @endphp

                            @if(is_null($diffMinutes))
                                N/A
                            @elseif($diffMinutes <= 0)
                                <span style="color:green;font-weight:bold;">Good 🤑</span>
                            @elseif($diffMinutes > 0 && $diffMinutes <= 30)
                                <span style="color:orange;font-weight:bold;">Poor 😒</span>
                            @else
                                <span style="color:red;font-weight:bold;">Bad 😡</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No attendance records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Attendance Performance Chart -->
    <div class="mb-5">
        <h4>Attendance Performance Summary</h4>
        <canvas id="attendanceChart" height="100"></canvas>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Initial chart reference
let attendanceChart;

// Function to render chart
function renderChart(performanceCounts) {
    const ctx = document.getElementById('attendanceChart').getContext('2d');

    if (attendanceChart) {
        attendanceChart.destroy(); // destroy previous chart before creating new one
    }

    attendanceChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Good', 'Poor', 'Bad'],
            datasets: [{
                label: 'Number of Attendances',
                data: [
                    performanceCounts.Good || 0,
                    performanceCounts.Poor || 0,
                    performanceCounts.Bad || 0
                ],
                backgroundColor: ['green', 'orange', 'red']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: true, text: 'Attendance Performance' }
            },
            scales: { y: { beginAtZero: true, precision: 0 } }
        }
    });
}

// Filter Attendance Table + Update Chart
function filterAttendance() {
    const month = document.getElementById('filter-month').value;
    const year = document.getElementById('filter-year').value;
    const name = document.getElementById('filter-name').value;

    const rows = document.querySelectorAll('#attendance-table tbody tr');
    let count = 0;

    // Initialize performance counts
    let performanceCounts = { Good: 0, Poor: 0, Bad: 0 };

    rows.forEach(row => {
        const rowMonth = row.getAttribute('data-month');
        const rowYear = row.getAttribute('data-year');
        const rowName = row.getAttribute('data-name');

        const matchMonth = !month || rowMonth === month;
        const matchYear = !year || rowYear === year;
        const matchName = !name || rowName === name;

        if (matchMonth && matchYear && matchName) {
            row.style.display = '';
            count++;

            // Count performance for chart
            const performanceCell = row.cells[6].textContent.trim();
            if (performanceCell.includes('Good')) performanceCounts.Good++;
            else if (performanceCell.includes('Poor')) performanceCounts.Poor++;
            else if (performanceCell.includes('Bad')) performanceCounts.Bad++;
        } else {
            row.style.display = 'none';
        }
    });

    document.getElementById('attendance-count').textContent = count;
    document.getElementById('print-button').style.display = (count > 0 && (month || year || name)) ? 'inline-block' : 'none';

    // Render chart with filtered data
    renderChart(performanceCounts);
}

// Print Filtered Attendance
function printFiltered() {
    const table = document.getElementById('attendance-table').cloneNode(true);
    const rows = table.querySelectorAll('tbody tr');

    rows.forEach(row => {
        if (row.style.display === 'none') row.remove();
    });

    const printWindow = window.open('', '', 'width=900,height=700');
    printWindow.document.write(`
        <html>
        <head>
            <title>Filtered Attendance Report</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                h2 { text-align: center; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                table, th, td { border: 1px solid #000; }
                th, td { padding: 8px; text-align: left; }
                img { width: 100px; height: auto; }
            </style>
        </head>
        <body>
            <h2>Filtered Attendance Report</h2>
            ${table.outerHTML}
        </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
}

// Initialize chart on page load with all data
document.addEventListener('DOMContentLoaded', function(){
    filterAttendance();
});
</script>



        
        
        
        <div class="container mt-4">

    <!-- Performance Chart Section -->
    

    <hr class="my-5">

    <!-- Profit & Loss Chart Section -->
    <h3>Company Purchase & Loss ({{ $selectedProfitYear }})</h3>
    <form method="GET" action="{{ route('home') }}" class="mb-3">
        <select name="profit_year" class="form-select w-auto d-inline-block" onchange="this.form.submit()">
            @foreach($profitYears as $year)
                <option value="{{ $year }}" {{ $year == $selectedProfitYear ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>
    </form>
    <canvas id="profitLossChart"></canvas>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Performance Chart
    new Chart(document.getElementById('performanceChart'), {
        type: 'line',
        data: {
            labels: @json(array_values($months)),
            datasets: [
                {
                    label: 'On Time',
                    data: @json(array_values($totalOnTime)),
                    borderColor: 'green',
                    fill: false
                },
                {
                    label: 'Late',
                    data: @json(array_values($totalLate)),
                    borderColor: 'red',
                    fill: false
                }
            ]
        }
    });

    // Profit & Loss Chart
    new Chart(document.getElementById('profitLossChart'), {
        type: 'bar',
        data: {
            labels: @json($profitMonths),
            datasets: [
                {
                    label: 'Purchase',
                    data: @json($profitData),
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                },
                {
                    label: 'Sell',
                    data: @json($lossData),
                    backgroundColor: 'rgba(255, 99, 132, 0.7)'
                }
            ]
        }
    });
</script>


        
        
        
        
    </div>
    @endif
    
    {{-- Subadmin View --}}
    @if(Auth::user()->role === 'subadmin')
    <div class="row g-3 my-3">
        <!-- Manage Customers -->
        <!--div class="col-md-4">
            <div class="card 
             text-center h-100">
                <div class="card-body">
                    <h6 class="card-title">Manage Franchise Customers</h6>
                    <a href="{{ route('subadmin.customers.index') }}" class="btn btn-outline-info">📋 View All</a>
                </div>
            </div>
        </div-->

        <!-- Add New Customer -->
        <!--div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <h6 class="card-title">Add New Customer</h6>
                    <a href="{{ route('subadmin.customers.create') }}" class="btn btn-outline-info">➕ Add Customer</a>
                </div>
            </div>
        </div--> <!--div class = "col-md-4">

        <div class="card text-center h-100">

        <div class="card-body">
            <div class="card-title">
                <h6 class = "card-title">Visit Records</h6>
                <a href = "{{ route('subadmin.warranties.index') }}" class="btn btn-outline-info"> View Warranties</a>
            </div>
        </div>

        </div>


        </div-->

        <!-- View Warranties -->
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <h6 class="card-title">Visit Records</h6>
                    <a href="{{ route('subadmin.warranties.index') }}" class="btn btn-outline-info">📋 View Warranties</a>
                </div>
            </div>
        </div>

        <!-- Visit List -->
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <h6 class="card-title">Visit List</h6>
                    <a href="{{ route('subadmin.warranties.create') }}" class="btn btn-outline-info">➕ Visit List</a>
                </div>
            </div>
        </div>
    </div>

<div class="container">
    <h2>Attendance List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filter Form -->
    <div class="form-inline mb-3">
        <div class="form-group mr-2">
            <label for="filter-month" class="mr-2">Month:</label>
            <select id="filter-month" class="form-control">
                <option value="">All</option>
                @foreach(range(1, 12) as $m)
                    <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mr-2">
            <label for="filter-year" class="mr-2">Year:</label>
            <select id="filter-year" class="form-control">
                <option value="">All</option>
                @for($y = date('Y'); $y >= 2020; $y--)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </select>
        </div>

        <div class="form-group mr-2">
            <label for="filter-name" class="mr-2">Employee Name:</label>
            <select id="filter-name" class="form-control">
                <option value="">All</option>
                @foreach($attendances->pluck('name')->unique() as $name)
                    <option value="{{ $name }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary" onclick="filterAttendance()">Search</button>
        <button id="print-button" class="btn btn-success ml-2" style="display:none;" onclick="printFiltered()">Print</button>
    </div>

    <!-- Total Count Display -->
    <p><strong>Total Attendance:</strong> <span id="attendance-count">{{ $attendances->count() }}</span></p>

    <!-- Attendance Table -->
    <div class="scrollmenu mb-4" style="display:none">
        <table class="table table-bordered" id="attendance-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Employee Name</th>
                    <th>Photo</th>
                    <th>Location</th>
                    <th>Reach Time</th>
                    <th>Target Time</th>
                    <th>Performance</th>
                </tr>
            </thead>
            <tbody >

                @forelse ($attendances as $attendance)
                    <tr data-name="{{ $attendance->name }}"
                        data-month="{{ \Carbon\Carbon::parse($attendance->datetime)->format('n') }}"
                        data-year="{{ \Carbon\Carbon::parse($attendance->datetime)->format('Y') }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $attendance->name }}</td>
                        <td>
                            <img src="{{ asset('storage/app/public/attendance/' . basename($attendance->photo)) }}" width="200">
                        </td>
                        <td>{{ $attendance->location }}</td>
                        <td>{{ \Carbon\Carbon::parse($attendance->datetime)->format('d M Y, h:i A') }}</td>
                        <td>
                            @if(!empty($attendance->employee?->date) && !empty($attendance->employee?->time))
                                {{ \Carbon\Carbon::parse($attendance->employee->date . ' ' . $attendance->employee->time)->format('d M Y, h:i A') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @php
                                if (!empty($attendance->employee?->date) && !empty($attendance->employee?->time)) {
                                    $actual = \Carbon\Carbon::parse($attendance->datetime);
                                    $expected = \Carbon\Carbon::parse($attendance->employee->date . ' ' . $attendance->employee->time);
                                    $diffMinutes = $expected->diffInMinutes($actual, false);
                                } else {
                                    $diffMinutes = null;
                                }
                            @endphp

                            @if(is_null($diffMinutes))
                                N/A
                            @elseif($diffMinutes <= 0)
                                <span style="color:green;font-weight:bold;">Good 🤑</span>
                            @elseif($diffMinutes > 0 && $diffMinutes <= 30)
                                <span style="color:orange;font-weight:bold;">Poor 😒</span>
                            @else
                                <span style="color:red;font-weight:bold;">Bad 😡</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No attendance records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Attendance Performance Chart -->
    <div class="mb-5">
        <h4>Attendance Performance Summary</h4>
        <canvas id="attendanceChart" height="100"></canvas>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Initial chart reference
let attendanceChart;

// Function to render chart
function renderChart(performanceCounts) {
    const ctx = document.getElementById('attendanceChart').getContext('2d');

    if (attendanceChart) {
        attendanceChart.destroy(); // destroy previous chart before creating new one
    }

    attendanceChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Good', 'Poor', 'Bad'],
            datasets: [{
                label: 'Number of Attendances',
                data: [
                    performanceCounts.Good || 0,
                    performanceCounts.Poor || 0,
                    performanceCounts.Bad || 0
                ],
                backgroundColor: ['green', 'orange', 'red']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: true, text: 'Attendance Performance' }
            },
            scales: { y: { beginAtZero: true, precision: 0 } }
        }
    });
}

// Filter Attendance Table + Update Chart
function filterAttendance() {
    const month = document.getElementById('filter-month').value;
    const year = document.getElementById('filter-year').value;
    const name = document.getElementById('filter-name').value;

    const rows = document.querySelectorAll('#attendance-table tbody tr');
    let count = 0;

    // Initialize performance counts
    let performanceCounts = { Good: 0, Poor: 0, Bad: 0 };

    rows.forEach(row => {
        const rowMonth = row.getAttribute('data-month');
        const rowYear = row.getAttribute('data-year');
        const rowName = row.getAttribute('data-name');

        const matchMonth = !month || rowMonth === month;
        const matchYear = !year || rowYear === year;
        const matchName = !name || rowName === name;

        if (matchMonth && matchYear && matchName) {
            row.style.display = '';
            count++;

            // Count performance for chart
            const performanceCell = row.cells[6].textContent.trim();
            if (performanceCell.includes('Good')) performanceCounts.Good++;
            else if (performanceCell.includes('Poor')) performanceCounts.Poor++;
            else if (performanceCell.includes('Bad')) performanceCounts.Bad++;
        } else {
            row.style.display = 'none';
        }
    });

    document.getElementById('attendance-count').textContent = count;
    document.getElementById('print-button').style.display = (count > 0 && (month || year || name)) ? 'inline-block' : 'none';

    // Render chart with filtered data
    renderChart(performanceCounts);
}

// Print Filtered Attendance
function printFiltered() {
    const table = document.getElementById('attendance-table').cloneNode(true);
    const rows = table.querySelectorAll('tbody tr');

    rows.forEach(row => {
        if (row.style.display === 'none') row.remove();
    });

    const printWindow = window.open('', '', 'width=900,height=700');
    printWindow.document.write(`
        <html>
        <head>
            <title>Filtered Attendance Report</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                h2 { text-align: center; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                table, th, td { border: 1px solid #000; }
                th, td { padding: 8px; text-align: left; }
                img { width: 100px; height: auto; }
            </style>
        </head>
        <body>
            <h2>Filtered Attendance Report</h2>
            ${table.outerHTML}
        </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
}

// Initialize chart on page load with all data
document.addEventListener('DOMContentLoaded', function(){
    filterAttendance();
});
</script>

<div class="container mt-4">

    
    <hr class="my-5">

    <!-- Profit & Loss Chart Section -->
    <h3>Company Purchase & Loss ({{ $selectedProfitYear }})</h3>
    <form method="GET" action="{{ route('home') }}" class="mb-3">
        <select name="profit_year" class="form-select w-auto d-inline-block" onchange="this.form.submit()">
            @foreach($profitYears as $year)
                <option value="{{ $year }}" {{ $year == $selectedProfitYear ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>
    </form>
    <canvas id="profitLossChart"></canvas>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Performance Chart
    new Chart(document.getElementById('performanceChart'), {
        type: 'line',
        data: {
            labels: @json(array_values($months)),
            datasets: [
                {
                    label: 'On Time',
                    data: @json(array_values($totalOnTime)),
                    borderColor: 'green',
                    fill: false
                },
                {
                    label: 'Late',
                    data: @json(array_values($totalLate)),
                    borderColor: 'red',
                    fill: false
                }
            ]
        }
    });

    // Profit & Loss Chart
    new Chart(document.getElementById('profitLossChart'), {
        type: 'bar',
        data: {
            labels: @json($profitMonths),
            datasets: [
                {
                    label: 'Purchase',
                    data: @json($profitData),
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                },
                {
                    label: 'Loss',
                    data: @json($lossData),
                    backgroundColor: 'rgba(255, 99, 132, 0.7)'
                }
            ]
        }
    });
</script>



    @endif

    
    @if(Auth::check() && Auth::user()->role === 'customer')

    <div class="row g-3 my-3">

        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <h6 class="card-title">Visit List</h6>
                    <a href="{{ route('customer.visits.index') }}" class="btn btn-outline-info">👁</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <h6 class="card-title">Add Review</h6>
                    <a href="https://www.google.com/search?q=wood+edge+tooling&oq=wo&gs_lcrp=EgZjaHJvbWUqDwgAECMYJxjjAhiABBiKBTIPCAAQIxgnGOMCGIAEGIoFMhUIARAuGCcYrwEYxwEYgAQYigUYjgUyDAgCEAAYQxiABBiKBTIGCAMQRRg5MgYIBBBFGDwyBggFEEUYPDIGCAYQRRg8MgYIBxBFGDzSAQgxMDk3ajBqN6gCALACAA&sourceid=chrome&ie=UTF-8#lrd=0x390ce70bec88a0a5:0x1ebea624d0e4c84f,1,,,," class="btn btn-outline-info">➕</a>
                </div>
            </div>
        </div>
        
        


</div>

  @endif
    
</div>
@endsection
