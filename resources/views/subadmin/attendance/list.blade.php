@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Attendance List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filter Form (Client-side with JavaScript) -->
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

    <div class="scrollmenu">
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
            <tbody>
                @forelse ($attendances as $attendance)
                    <tr data-name="{{ $attendance->name }}"
                        data-month="{{ \Carbon\Carbon::parse($attendance->datetime)->format('n') }}"
                        data-year="{{ \Carbon\Carbon::parse($attendance->datetime)->format('Y') }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $attendance->name }}</td>
                        <td><img src="{{ asset('storage/app/public/attendance/' . basename($attendance->photo)) }}" width="200"></td>
                        <td>{{ $attendance->location }}</td>
                      <td>{{ \Carbon\Carbon::parse($attendance->datetime)->format('d M Y, h:i A') }}</td>

<td>
    @if(!empty($attendance->date) && !empty($attendance->time))
        {{ \Carbon\Carbon::parse($attendance->date . ' ' . $attendance->time)->format('d M Y, h:i A') }}
    @else
        N/A
    @endif
</td>

{{-- ✅ New column: Punctuality Status --}}
<td>
    @php
        if (!empty($attendance->date) && !empty($attendance->time)) {
            $actual = \Carbon\Carbon::parse($attendance->datetime);
            $expected = \Carbon\Carbon::parse($attendance->date . ' ' . $attendance->time);
            $diffMinutes = $expected->diffInMinutes($actual, false); // negative if early
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
                        <td colspan="5">No attendance records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function filterAttendance() {
    const month = document.getElementById('filter-month').value;
    const year = document.getElementById('filter-year').value;
    const name = document.getElementById('filter-name').value;

    const rows = document.querySelectorAll('#attendance-table tbody tr');
    let count = 0;

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
        } else {
            row.style.display = 'none';
        }
    });

    document.getElementById('attendance-count').textContent = count;

    // Show print button only if filters applied and results found
    document.getElementById('print-button').style.display = (count > 0 && (month || year || name)) ? 'inline-block' : 'none';
}

function printFiltered() {
    const table = document.getElementById('attendance-table').cloneNode(true);
    const rows = table.querySelectorAll('tbody tr');

    // Remove hidden rows
    rows.forEach(row => {
        if (row.style.display === 'none') {
            row.remove();
        }
    });

    // Open printable view
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
</script>
@endsection
