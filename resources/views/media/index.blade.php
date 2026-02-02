{{-- resources/views/media/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Media — MyBlog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .alert{
            margin-top:14px;
            padding:12px 14px;
            border-radius:14px;
            border:1px solid rgba(34,197,94,.35);
            background: rgba(34,197,94,.10);
            color:#bbf7d0;
            font-weight:800;
        }

        .media-top{
            display:flex;
            gap:12px;
            align-items:center;
            justify-content:space-between;
            flex-wrap:wrap;
        }

        .searchbar{
            display:flex;
            align-items:center;
            gap:10px;
            padding:10px 12px;
            border-radius:14px;
            background:rgba(0,0,0,.18);
            border:1px solid var(--border);
            min-width: 280px;
        }
        .searchbar input{
            width:100%;
            background:transparent;
            border:0;
            outline:0;
            color:var(--text);
            font-size:.95rem;
            min-width: 200px;
        }

        .upload{
            display:flex;
            gap:10px;
            align-items:center;
            flex-wrap:wrap;
        }

        .file{
            padding:10px 12px;
            border-radius:14px;
            border:1px solid var(--border);
            background:rgba(0,0,0,.18);
            color:var(--text);
        }

        .btn-primary{
            border:1px solid rgba(124,92,255,.35);
            background:linear-gradient(135deg, rgba(124,92,255,.95), rgba(56,189,248,.70));
            color:white;
            font-weight:900;
            padding:10px 14px;
            border-radius:14px;
            cursor:pointer;
        }
        .btn-ghost{
            border:1px solid var(--border);
            background:rgba(255,255,255,.06);
            color:var(--text);
            font-weight:900;
            padding:10px 14px;
            border-radius:14px;
            cursor:pointer;
        }

        .grid{
            margin-top:14px;
            display:grid;
            grid-template-columns: repeat(3, 1fr);
            gap:14px;
        }
        @media(max-width: 1050px){
            .grid{ grid-template-columns: repeat(2, 1fr); }
        }
        @media(max-width: 650px){
            .grid{ grid-template-columns: 1fr; }
        }

        .media-card{
            border:1px solid var(--border);
            background:rgba(255,255,255,.04);
            border-radius:18px;
            overflow:hidden;
        }
        .thumb{
            width:100%;
            height:180px;
            object-fit:cover;
            display:block;
            background:rgba(0,0,0,.25);
        }
        .meta{
            padding:12px;
            display:flex;
            flex-direction:column;
            gap:10px;
        }
        .name{
            font-weight:900;
            line-height:1.2;
            word-break:break-word;
        }
        .muted{color:var(--muted); font-size:.9rem;}

        .actions{
            display:flex;
            gap:10px;
            flex-wrap:wrap;
        }

        .btn-sm{
            padding:8px 10px;
            border-radius:12px;
            font-weight:900;
            border:1px solid var(--border);
            background:rgba(255,255,255,.06);
            color:var(--text);
            cursor:pointer;
        }
        .btn-danger{
            border-color: rgba(239,68,68,.35);
            background: rgba(239,68,68,.12);
        }

        .pager{margin-top:14px;}
    </style>
</head>
<body>

@include('common.header')

@push('page-content')

@if(session('success'))
    <div class="alert">{{ session('success') }}</div>
@endif

<div class="card" style="margin-top:18px;">
    <div class="media-top">
        <div>
            <h2 style="margin-bottom:6px;">Media Library</h2>
            <p style="color: var(--muted); margin:0;">Upload images and reuse them in posts. Click “Copy URL” to use inside your content.</p>
        </div>

        <form method="GET" action="{{ route('media.index') }}" class="searchbar">
            <span>🔎</span>
            <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Search media...">
        </form>
    </div>

    <form method="POST" action="{{ route('media.store') }}" enctype="multipart/form-data" class="upload" style="margin-top:14px;">
        @csrf
        <input class="file" type="file" name="files[]" accept="image/*" multiple required>
        <button class="btn-primary" type="submit">Upload</button>
    </form>

    <div class="grid">
        @forelse($media as $item)
            @php
                $url = asset('storage/' . $item->file_path);
            @endphp

            <div class="media-card">
                <img class="thumb" src="{{ $url }}" alt="{{ $item->file_name }}">

                <div class="meta">
                    <div class="name">{{ $item->file_name }}</div>
                    <div class="muted">
                        {{ round($item->size / 1024) }} KB • {{ $item->created_at->format('Y-m-d') }}
                    </div>

                    <div class="actions">
                        <button class="btn-sm" type="button" onclick="navigator.clipboard.writeText('{{ $url }}')">
                            Copy URL
                        </button>

                        @if($item->user_id === auth()->id())
                            <form method="POST" action="{{ route('media.destroy', $item) }}" onsubmit="return confirm('Delete this media?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn-sm btn-danger" type="submit">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="t-empty" style="grid-column:1/-1;">No media yet. Upload your first image.</div>
        @endforelse
    </div>

    <div class="pager">
        {{ $media->links() }}
    </div>
</div>

@endpush

@include('common.inner')

</body>
</html>
