@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Warranty</h2>

    <form action="{{ route('customer.warranties.update', $warranty->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('customer.warranties.form', ['warranty' => $warranty])

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
