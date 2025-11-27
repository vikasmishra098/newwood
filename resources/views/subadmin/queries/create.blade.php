@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Task</h2>

    <form action="{{ route('subadmin.queries.store') }}" method="POST">
        @csrf
        @include('subadmin.queries.form')





        
        <button class="btn btn-success">Save Task</button>
    </form>
</div>
@endsection
