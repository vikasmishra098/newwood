@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Company Purchase & Sell</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('admin.companyprofit.view') }}" class="mb-3 d-flex gap-2">
        <select name="year" class="form-control" style="max-width:200px;">
            <option value="">-- Select Year --</option>
            @foreach($years as $year)
                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="{{ route('admin.companyprofit.view') }}" class="btn btn-secondary">Reset</a>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
@if(request('year'))
    @php
        $profit = $totalLoss - $totalProfit;
    @endphp

    <div class="alert alert-info">
        <strong>Year: {{ request('year') }}</strong><br>
        Total Purchase: {{ $totalProfit }} <br>
        Total Sell: {{ $totalLoss }}<br>
        
        Profit = 
        @if($profit < 0)
            <span style="color: red; background-color: yellow; padding: 2px 6px; border-radius: 4px;">
                {{ $profit }}
            </span>
        @else
            <span style="color: green; font-weight: bold;">
                {{ $profit }}
            </span>
        @endif
    </div>
@endif


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Purchase</th>
                <th>Sell</th>
                <th>Entry Date</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($profits as $profit)
            <tr>
                <td>{{ $profit->id }}</td>
                <td>{{ $profit->profit_amount }}</td>
                <td>{{ $profit->loss_amount }}</td>
                <td>{{ $profit->entry_date ? \Carbon\Carbon::parse($profit->entry_date)->format('d-m-Y h:i A') : '-' }}</td>
                <td>{{ $profit->created_at->format('d-m-Y h:i A') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No records found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
