@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Employee</h2>

    <form action="{{ route(auth()->user()->role . '.employee.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mt-3">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $employee->name }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $employee->email }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="designation">Designation</label>
            <input type="text" name="designation" class="form-control" value="{{ $employee->designation }}">
        </div>

        <div class="form-group mt-3">
            <label for="address">Address</label>
            <textarea name="address" class="form-control">{{ $employee->address }}</textarea>
        </div>

        <button type="submit" class="btn btn-success mt-3">💾 Update</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">⬅ Cancel</a>
    </form>
</div>
@endsection
