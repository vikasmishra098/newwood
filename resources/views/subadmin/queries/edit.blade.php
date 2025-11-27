@extends('layouts.app')

@section('content')
<h2>Edit Task</h2>

<form action="{{ route('subadmin.queries.update', $query->id) }}" method="POST">
    @method('PUT')
    @include('subadmin.queries.form')
</form>
@endsection
