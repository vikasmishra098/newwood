@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Visit</h2>

    <form action="{{ route('subadmin.visits.store') }}" method="POST">

        @csrf
         <div class="form-group">
    <label>Employee</label>
    <select name="employee_id" class="form-control" required>
        <option value="">-- Select Employee --</option>
        @foreach($employees as $employee)
            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
        @endforeach
    </select>
</div>

        <div class="form-group">
            <label>Company Name</label>
            <select name="company_id" class="form-control" required>
                <option value="">-- Select Company --</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Machine Name</label>
            <input type="text" name="machine_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Add Parts</label>
            <textarea name="add_parts" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Required Parts</label>
            <textarea name="required_parts" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Receive Parts</label>
            <textarea name="receive_parts" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Start Time</label>
            <input type="time" name="start_time" class="form-control">
        </div>

        <div class="form-group">
            <label>End Time</label>
            <input type="time" name="end_time" class="form-control">
        </div>

        <div class="form-group">
            <label>Who Solve</label>
            <input type="text" name="who_solve" class="form-control">
        </div>

        <div class="form-group">
            <label>Problem</label>
            <textarea name="problem" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending">Pending</option>
                <option value="in-progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Visit</button>
    </form>
</div>
@endsection
