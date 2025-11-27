@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Visit List</h2>

    <form action="{{ route(auth()->user()->role . '.warranties.store') }}" method="POST">
        @csrf

        @include('admin.warranties.form')

        <button type="submit" class="btn btn-success mt-3">Submit</button>
    </form>
</div>
@endsection
