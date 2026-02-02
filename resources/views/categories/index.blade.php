{{-- resources/views/categories/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories — MyBlog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .cat-grid{
            display:grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap:14px;
            margin-top:18px;
        }
        .cat-card{
            display:block;
            padding:16px;
            border-radius:18px;
            border:1px solid var(--border);
            background: rgba(0,0,0,.18);
            text-decoration:none;
            transition:.15s;
        }
        .cat-card:hover{
            background: var(--panel);
            transform: translateY(-1px);
            border-color: rgba(124,92,255,.35);
        }
        .cat-title{
            font-weight:900;
            font-size:1.05rem;
        }
        .cat-meta{
            margin-top:8px;
            color: var(--muted);
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:10px;
        }
        .cat-pill{
            font-size:.8rem;
            padding:4px 10px;
            border-radius:999px;
            border:1px solid var(--border);
            background: rgba(255,255,255,.06);
            color: var(--muted);
            white-space:nowrap;
        }

        @media (max-width: 900px){
            .cat-grid{ grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 560px){
            .cat-grid{ grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

@include('common.header')

@push('page-content')
<div class="card" style="margin-top:18px;">
    <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap;">
        <div>
            <h2 style="margin-bottom:6px;">Categories</h2>
            <p style="color:var(--muted); margin:0;">Choose a category to see all posts inside it.</p>
        </div>
        <a class="btn btn-primary" href="{{ route('posts.create') }}">+ New Post</a>
    </div>

    <div class="cat-grid">
        @forelse($categories as $cat)
            <a class="cat-card" href="{{ route('categories.show', $cat) }}">
                <div class="cat-title">{{ $cat->name }}</div>
                <div class="cat-meta">
                    <span>{{ $cat->slug }}</span>
                    <span class="cat-pill">{{ $cat->posts_count }} posts</span>
                </div>
            </a>
        @empty
            <div class="t-empty">No categories found.</div>
        @endforelse
    </div>
</div>
@endpush

@include('common.inner')

</body>
</html>
