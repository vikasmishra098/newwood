@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Blogs</h2>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary mb-3">➕ Add Blog</a>
<input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by any field...">

    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
        <table class="table table-bordered table-striped" id="warrantyTable">
        <thead>
            <tr>
                <th>📌 Title</th>
                <th>📝 Content</th>
                <th>🖼️ Image</th>
                <th>⚙️ Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
                <tr>
                    <td>{{ $blog->title }}</td>
                    <td>{{ Str::limit($blog->content, 100) }}</td>
                    <td>
                        @if ($blog->image)
                            <img src="{{ asset('storage/app/public/' . $blog->image) }}" width="80" />
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning">✏️ </a>
                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">🗑</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

     <nav class="mt-3 d-flex justify-content">
        <ul class="pagination" id="pagination"></ul>
    </nav>
    <div>
</div>
@endsection
