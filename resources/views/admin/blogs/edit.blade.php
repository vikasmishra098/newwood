@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Blog</h2>

    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.blogs.form', ['blog' => $blog])
        <button type="submit" class="btn btn-primary">💾 Update</button>
    </form>
</div>
@endsection
