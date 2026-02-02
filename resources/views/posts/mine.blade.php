{{-- resources/views/posts/mine.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Posts — MyBlog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .actions-inline{display:flex; gap:10px; justify-content:flex-end; flex-wrap:wrap;}
        .btn-sm{
            padding:8px 10px;
            border-radius:12px;
            font-weight:900;
            border:1px solid var(--border);
            background:rgba(255,255,255,.06);
            color:var(--text);
            cursor:pointer;
        }
        .btn-sm:hover{background:rgba(255,255,255,.10);}
        .btn-danger{
            border-color: rgba(239,68,68,.35);
            background: rgba(239,68,68,.12);
        }
        .btn-danger:hover{background: rgba(239,68,68,.18);}
        .alert{
            margin-top:14px;
            padding:12px 14px;
            border-radius:14px;
            border:1px solid rgba(34,197,94,.35);
            background: rgba(34,197,94,.10);
            color:#bbf7d0;
            font-weight:800;
        }
            /* ===== FORCE DARK SEARCH INPUT ===== */

.search-form input[type="text"]{
    background:
        linear-gradient(135deg, rgba(124,92,255,.12), rgba(56,189,248,.06)),
        rgba(0,0,0,.22) !important;

    color: var(--text) !important;
    border: 1px solid var(--border) !important;
    border-radius: 14px;
    padding: 10px 14px;

    outline: none;
}

/* Placeholder text */
.search-form input::placeholder{
    color: rgba(231,238,252,.6);
}

/* Focus glow */
.search-form input:focus{
    border-color: rgba(124,92,255,.65) !important;
    box-shadow: 0 0 0 4px rgba(124,92,255,.18);
}

/* Button same theme */
.search-form button{
    border:1px solid rgba(124,92,255,.35);
    background:linear-gradient(135deg,
        rgba(124,92,255,.95),
        rgba(56,189,248,.70)
    );

    color:white;
    font-weight:900;
    padding:10px 16px;
    border-radius:14px;
    cursor:pointer;
}

.search-form button:hover{
    filter:brightness(1.05);
}

    </style>
</head>
<body>

@include('common.header')

@push('page-content')

@if(session('success'))
    <div class="alert">{{ session('success') }}</div>
@endif

<div class="card" style="margin-top:18px;">
    <div style="display:flex; gap:12px; align-items:center; justify-content:space-between; flex-wrap:wrap;">
        <div>
            <h2 style="margin-bottom:6px;">My Posts</h2>
            <p style="color: var(--muted); margin:0;">Only the posts you created. You can edit or delete them.</p>
        </div>

        <form method="GET" action="{{ route('posts.mine') }}">
            <input class="input" type="text" name="q" value="{{ $q ?? '' }}" placeholder="Search my posts...">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </div>

    <div class="table" style="margin-top:14px;">
        <div class="t-head">
            <div>Title</div>
            <div>Status</div>
            <div>Created</div>
            <div style="text-align:right;">Actions</div>
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

                <div class="actions-inline">
                    <a class="btn-sm" href="{{ route('posts.edit', $post) }}">Edit</a>

                    <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="t-empty">You haven’t created any posts yet.</div>
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
