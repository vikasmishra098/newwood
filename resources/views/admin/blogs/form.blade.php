<div class="form-group mb-3">
    <label for="title">Title</label>
    <input type="text" name="title" value="{{ old('title', $blog->title ?? '') }}" class="form-control" required>
</div>

<div class="form-group mb-3">
    <label for="content">Content</label>
    <textarea name="content" rows="4" class="form-control" required>{{ old('content', $blog->content ?? '') }}</textarea>
</div>

<div class="form-group mb-3">
    <label for="image">Image</label>
    <input type="file" name="image" class="form-control">
    @if (!empty($blog->image))
        <img src="{{ asset('storage/' . $blog->image) }}" width="100" class="mt-2">
    @endif
</div>
