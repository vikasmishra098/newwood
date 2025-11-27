@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Blog</h2>

    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.blogs.form')
        <button type="submit" class="btn btn-success">✅ Save</button>
    </form>
</div>
@endsection
