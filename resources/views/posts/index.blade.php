{{-- resources/views/posts/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Posts — MyBlog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

@include('common.header')

@push('page-content')
<div class="card" style="margin-top:18px;">
    <div style="display:flex; gap:12px; align-items:center; justify-content:space-between; flex-wrap:wrap;">
        <div>
            <h2 style="margin-bottom:6px;">All Posts</h2>
            <p style="color: var(--muted); margin:0;">View posts created by you and other users.</p>
        </div>

        <form method="GET" action="{{ route('posts.index') }}" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
            <input class="input" type="text" name="q" value="{{ $q ?? '' }}" placeholder="Search posts..." style="min-width:260px;">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
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
                    {{-- If you don't have posts.show route yet, change to: href="#" --}}
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

                <div class="t-muted">
                    {{ $post->created_at->format('Y-m-d') }}
                </div>
            </div>
        @empty
            <div class="t-empty">No posts found.</div>
        @endforelse
    </div>

    <div style="margin-top:14px;">
        {{ $posts->links() }}
    </div>
</div>
@endpush

@include('common.inner')



<style>
/* Keep this here, OR (better) move it into inner.blade.php style once */
.input{
    padding:10px 12px;
    border-radius:14px;
    border:1px solid var(--border);
    background:rgba(0,0,0,.18);
    color:var(--text);
    outline:none;
}
.input:focus{
    border-color:rgba(124,92,255,.65);
    box-shadow:0 0 0 4px rgba(124,92,255,.18);
}
</style>

</body>
</html>
