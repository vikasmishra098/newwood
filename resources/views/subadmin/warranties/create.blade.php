@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Visit List (Subadmin)</h2>

   <form action="{{ route(auth()->user()->role . '.warranties.store') }}" method="POST">
    @csrf

        @include('subadmin.warranties.form')

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
@endsection
