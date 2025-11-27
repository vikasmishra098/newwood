@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Company Purchase/Sell</h2>
    <form action="{{ route('admin.companyprofit.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="profit_amount" class="form-label">Purchase  Amount</label>
            <input type="number" name="profit_amount" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="loss_amount" class="form-label">Sell Amount</label>
            <input type="number" name="loss_amount" class="form-control" step="0.01" required>
            
        </div>
        
        <div class="mb-3">
            <label class="form-label">Select Date & Time</label>
            <input type="datetime-local" name="entry_date" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
