{{-- resources/views/categories/show.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $category->name }} — Categories</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

@include('common.header')

@push('page-content')
<div class="card" style="margin-top:18px;">
    <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:12px; flex-wrap:wrap;">
        <div>
            <h2 style="margin-bottom:6px;">{{ $category->name }}</h2>
            <p style="color:var(--muted); margin:0;">All posts in this category.</p>
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a class="btn" href="{{ route('categories.index') }}">← Back</a>
            <a class="btn btn-primary" href="{{ route('posts.create') }}">+ New Post</a>
        </div>
    </div>

    <div class="table" style="margin-top:14px;">
        <div class="t-head">
            <div>Title</div>
            <div>Status</div>
            <div>Created</div>
        </div>

        @forelse($posts as $post)
            <div class="t-row">
                <div class="t-title">
                    <a href="{{ route('posts.show', $post) }}" style="text-decoration:underline;">
                        {{ $post->title }}
                    </a>
                    <div class="t-muted" style="font-size:.85rem; margin-top:4px;">
                        {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 70) }}
                    </div>
                </div>

                <div>
                    <span class="status {{ $post->status }}">{{ ucfirst($post->status) }}</span>
                </div>

                <div class="t-muted">{{ $post->created_at->format('Y-m-d') }}</div>
            </div>
        @empty
            <div class="t-empty">No posts in this category yet.</div>
        @endforelse
    </div>

    <div style="margin-top:14px;">
        {{ $posts->links() }}
    </div>
</div>
@endpush

@include('common.inner')

</body>
</html>
