@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Task</h2>

    <form action="{{ route('admin.queries.update', $query->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.queries.form', ['query' => $query])
        <button class="btn btn-primary">Update Task</button>
    </form>
</div>
@endsection
