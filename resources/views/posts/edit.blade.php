{{-- resources/views/posts/edit.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post — MyBlog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

@include('common.header')

@push('page-content')
<div class="card" style="margin-top:18px;">
    <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:12px; flex-wrap:wrap;">
        <div>
            <h2 style="margin-bottom:6px;">Edit Post</h2>
            <p style="color:var(--muted); margin:0;">Update your post and save changes.</p>
        </div>
        <a class="btn" href="{{ route('posts.mine') }}">← Back</a>
    </div>

    @if($errors->any())
        <div class="errors" style="margin-top:14px;">
            <strong>Please fix these errors:</strong>
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="form" method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" style="margin-top:14px;">
        @csrf
        @method('PUT')

        <div>
            <label>Post Title
                <input class="input" type="text" name="title" value="{{ old('title', $post->title) }}" required>
            </label>
        </div>

        <div>
            <label>Slug
                <input class="input" type="text" name="slug" value="{{ old('slug', $post->slug) }}">
            </label>
        </div>

        <div class="row">
            <div>
                <label>Category
                    <select class="input" name="category_id">
                        <option value="">Select category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div>
                <label>Status
                    <select class="input" name="status" required>
                        <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Publish</option>
                    </select>
                </label>
            </div>
        </div>

        <div>
            <label>Featured Image
                <input class="input" type="file" name="image" accept="image/*">
            </label>
            @if($post->image_path)
                <div class="help" style="margin-top:8px;">
                    Current image:
                    <a href="{{ asset('storage/'.$post->image_path) }}" target="_blank" style="text-decoration:underline;">
                        View
                    </a>
                </div>
            @endif
        </div>

        <div>
            <label>Content
                <textarea class="input" name="content" required>{{ old('content', $post->content) }}</textarea>
            </label>
        </div>

        <div class="actions">
            <a class="btn-outline" href="{{ route('posts.mine') }}">Cancel</a>
            <button class="btn" type="submit">Update Post</button>
        </div>
    </form>
</div>
@endpush

@include('common.inner')

</body>
</html>
