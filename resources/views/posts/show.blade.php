{{-- resources/views/posts/show.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $post->title }} — MyBlog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

@include('common.header')

@push('page-content')
<div class="card" style="margin-top:18px;">
    <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:12px; flex-wrap:wrap;">
        <div>
            <h2 style="margin-bottom:8px;">{{ $post->title }}</h2>
            <div class="t-muted">
                <span class="status {{ $post->status }}">{{ ucfirst($post->status) }}</span>
                <span style="margin-left:10px;">{{ $post->created_at->format('Y-m-d') }}</span>
            </div>
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a class="btn" href="{{ route('posts.index') }}">← Back</a>
            <a class="btn btn-primary" href="{{ url('/posts/create') }}">+ New Post</a>
        </div>
    </div>

    @if($post->image_path)
        <div style="margin-top:16px;">
            <img
                src="{{ asset('storage/'.$post->image_path) }}"
                alt="Featured image"
                style="width:100%; max-height:360px; object-fit:cover; border-radius:16px; border:1px solid var(--border);"
            >
        </div>
    @endif

    <div style="margin-top:16px; line-height:1.8; color:var(--text);">
        {!! nl2br(e($post->content)) !!}
    </div>
</div>
@endpush

@include('common.inner')

</body>
</html>
