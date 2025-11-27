@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Visit</h2>

    <form action="{{ route('subadmin.visits.update', $visit->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Employee</label>
            <select name="employee_id" class="form-control">
                @foreach($employees as $emp)
                    <option value="{{ $emp->id }}" {{ $visit->employee_id == $emp->id ? 'selected' : '' }}>
                        {{ $emp->name }}
                    </option>
                @endforeach
            </select>
        </div>
<div class="form-group">
            <label>Company</label>
            <select name="company_id" class="form-control" required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ $visit->company_id == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Machine Name</label>
            <input type="text" name="machine_name" class="form-control" value="{{ $visit->machine_name }}">
        </div>

        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" class="form-control" value="{{ $visit->date }}">
        </div>

        <div class="form-group">
            <label>Add Parts</label>
            <textarea name="add_parts" class="form-control">{{ $visit->add_parts }}</textarea>
        </div>

        <div class="form-group">
            <label>Required Parts</label>
            <textarea name="required_parts" class="form-control">{{ $visit->required_parts }}</textarea>
        </div>

        <div class="form-group">
            <label>Receive Parts</label>
            <textarea name="receive_parts" class="form-control">{{ $visit->receive_parts }}</textarea>
        </div>

        <div class="form-group">
            <label>Start Time</label>
            <input type="time" name="start_time" class="form-control" value="{{ $visit->start_time }}">
        </div>

        <div class="form-group">
            <label>End Time</label>
            <input type="time" name="end_time" class="form-control" value="{{ $visit->end_time }}">
        </div>

        <div class="form-group">
            <label>Who Solve</label>
            <input type="text" name="who_solve" class="form-control" value="{{ $visit->who_solve }}">
        </div>

        <div class="form-group">
            <label>Problem</label>
            <textarea name="problem" class="form-control">{{ $visit->problem }}</textarea>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $visit->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in-progress" {{ $visit->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ $visit->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <!--button type="submit" class="btn btn-success">Update Visit</button-->
    </form>
</div>
@endsection